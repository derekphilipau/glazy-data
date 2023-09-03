# glazy-data
Public data from the Glazy database

## Usage

Please see [Pieter Mostert's Glazy Data Analysis project](https://github.com/PieterMostert/glazy-data-analysis) to understand some of the challenges with using this data.

In particular, there are a number of duplicate recipes and similar recipes with only slight variations.

## Data Files

### glazy-[DATE].yaml.gz

Compressed, human-readable YAML file that contains the all publicly archived materials and recipes in the Glazy database.

### glazy-data-[TYPE]-[DATE].csv

Legacy CSV files that contain material & recipe metadata and analyses.

 * "all" - Contains composites (recipes- gazes and clay bodies) as well as primitive materials (e.g. Whiting, Silica)
 * "composites"  - Composites are any recipe (a material made up of multiple materials)
 * "glazes" - Contains only Glazes (a subset of Composites)

#### CSV Field definitions:

 * id: Material/Recipe ID in Glazy
 * name: Name of material
 * created_by_user_id: The user ID in Glazy
 * material_type_id: Categorizes the material, e.g. "Celadon".  
 * material_type: Name of the material category.  May have duplicates, as material_type is a tree.  e.g. "Celadon -> Blue" and "Blue"
 * material_type_concatenated: Full name of the material category.  Includes the full Material Type path separated by " - ", e.g. "Iron - Celadon - Blue"
 * material_state_id: ID of the material's state: Testing, Production, or Discontinued
 * material_state: Testing, Production, or Discontinued
 * rgb_r, rgb_g, rgb_b: RGB values that represent the color of the glaze.  Usually taken from a photo.  Not reliable.
 * surface_type:
   - 1	Matte
   - 2	Matte - Stony
   - 3	Matte - Dry
   - 4	Matte - Semi
   - 5	Matte - Smooth
   - 6	Satin
   - 7	Satin - Matte
   - 8	Glossy
   - 9	Glossy - Semi
 * transparency_type:
   - 1	Opaque
   - 2	Semi-opaque
   - 3	Translucent
   - 4	Transparent
 * from_orton_cone, to_orton_cone: The temperature range for the material
 * is_analysis: If true, this is simply a chemical analysis, for example an analysis of a Song Dynasty celadon glaze.
 * is_primitive: Primitive materials are actual materials such as EPK, Whiting, Silica, etc.
 * is_theoretical: Theoretical materials are primitive materials like Kaolin and Potash Feldspar that are based on formulas.
 * is_private: If true, only visible to the user who created this material.
 * SiO2_percent, Al2O3_percent, B2O3_percent, etc.: Percentage analysis
 * Al2O3_umf, B2O3_umf, etc.:  UMF analysis
 * Al2O3_percent_mol, B2O3_percent_mol, etc: Percent Mol analysis
 * SiO2_Al2O3_ratio_umf: Silica Alumina ratio
 * R2O_umf, RO_umf: Totals for R2O and RO values in UMF
 * loi: Loss on Ignition
 
#### CSV Analysis Field Definitions:

* PERCENT ANALYSIS: denoted by XXXX_percent fields, e.g. SiO2_percent
* UMF ANALYSIS: denoted by XXXX_umf fields, e.g. SiO2_umf
* EXTENDED UMF ANALYSIS: denoted by XXXX_xumf fields, e.g. SiO2_xumf
* MOL ANALYSIS: denoted by XXXX_mol fields, e.g. SiO2_mol
* %MOL ANALYSIS: denoted by XXXX_percent_mol fields, e.g. SiO2_percent_mol
* UMF Ratios:  SiO2_Al2O3_ratio_umf, R2O_umf, RO_umf
* EXTENDED UMF Ratios: SiO2_Al2O3_ratio_xumf, R2O_xumf, RO_xumf
* LOI: loi
