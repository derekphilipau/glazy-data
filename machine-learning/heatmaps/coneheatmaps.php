<?php

$cone_lookup = [
    1 => '022',
    2 => '021',
    3 => '020',
    4 => '019',
    5 => '018',
    6 => '017',
    7 => '016',
    8 => '015',
    9 => '014',
    10 => '013',
    11 => '012',
    12 => '011',
    13 => '010',
    14 => '09',
    15 => '08',
    16 => '07',
    17 => '06',
    18 => '05.5',
    19 => '05',
    20 => '04',
    21 => '03',
    22 => '02',
    23 => '01',
    24 => '1',
    25 => '2',
    26 => '3',
    27 => '4',
    28 => '5',
    29 => '5.5',
    30 => '6',
    31 => '7',
    32 => '8',
    33 => '9',
    34 => '10',
    35 => '11',
    36 => '12',
    37 => '13',
    38 => '14'
];

$heatmaps = [];
$all_cones = [];

for ($cone = 1; $cone <= 38; $cone++) {
    $heatmaps[strval($cone)] = [];
    for ($sio2 = 0; $sio2 <= 8; $sio2 += 0.5) {
        $sio2val = number_format(round($sio2*2)/2, 1);
        $heatmaps[strval($cone)][$sio2val] = [];
        $all_cones[$sio2val] = [];
        for ($al2o3 = 0; $al2o3 <= 1; $al2o3 += 0.1) {
            $heatmaps[strval($cone)][$sio2val][number_format($al2o3, 1)] = '0';
            $all_cones[$sio2val][number_format($al2o3, 1)] = '0';
        }
    }
}

$umf_handle = fopen("../data/20210409_glazes_unique_regression_limited_umf.csv", "r");
if (!$umf_handle) { return; }
while (($data = fgetcsv($umf_handle, 1000, ",")) !== FALSE) {
    // 'cone', 'SiO2', 'Al2O3', 'B2O3', 'R2O', 'RO'
    $cone = round($data[0]);
    $sio2 = number_format(round($data[1]*2)/2, 1); // 0.0, 0.5, 1.0, etc.
    $al2o3 = number_format($data[2], 1); // 0.1, 0.2, etc.
    $b2o3 = $data[3];
    $r2o = $data[4];
    $ro = $data[5];

    if ($sio2 <= 8 && $al2o3 <= 1) {
        if (!isset($heatmaps[$cone])) { $heatmaps[$cone] = []; }
        if (!isset($heatmaps[$cone][$sio2])) { $heatmaps[$cone][$sio2] = []; }
        if (!isset($heatmaps[$cone][$sio2][$al2o3])) { $heatmaps[$cone][$sio2][$al2o3] = 0; }
        if (!isset($all_cones[$sio2][$al2o3])) { $all_cones[$sio2][$al2o3] = 0; }
        $heatmaps[$cone][$sio2][$al2o3] = $heatmaps[$cone][$sio2][$al2o3] + 1;
        $all_cones[$sio2][$al2o3] = $all_cones[$sio2][$al2o3] + 1;
    }
}
fclose($umf_handle);


for ($cone = 1; $cone <= 38; $cone++) {
    $fp = fopen('csv/'.$cone_lookup[$cone].'.csv', 'w');
    for ($sio2 = 0; $sio2 <= 8; $sio2 += 0.5) {
        $sio2val = number_format(round($sio2*2)/2, 1);
        fputcsv($fp, array_merge([$sio2val], $heatmaps[strval($cone)][$sio2val]));
    }
    fclose($fp);
}

$fp = fopen('csv/all.csv', 'w');
for ($sio2 = 0; $sio2 <= 8; $sio2 += 0.5) {
    $sio2val = number_format(round($sio2*2)/2, 1);
    fputcsv($fp, array_merge([$sio2val], $all_cones[$sio2val]));
}
fclose($fp);

echo 'here';