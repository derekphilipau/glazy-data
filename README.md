# glazy-data
Public data from the Glazy database

## About

The Glazy database of ceramic recipes was originally seeded with data from [Linda Arbuckle's](http://lindaarbuckle.com)  [GlazeChem database](http://lindaarbuckle.com/arbuckle_handouts.html), John Sankey's [glaze database](http://www.johnsankey.ca/glazedata.html) (which is based on the extensive work by [Alisa Clausen](https://glazy.org/u/alisaclausen)), and [Louis Katz's](http://www.louiskatz.net) [Hyperglaze database](http://falcon.tamucc.edu/~lkatz/allglazes.txt).

This repository intends to continue the tradition of making recipes publicly available.  This archived data only includes publicly shared recipes and materials.  It does not include any private data.

## Copyright & License

Note that although recipes themselves are not copyrightable, other Glazy user data, including descriptions, images, and other metadata, is copyrightable.  All publicly shared data on Glazy is licensed under [Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)](https://creativecommons.org/licenses/by-nc-sa/4.0/).  This repository is also licensed under [CC BY-NC-SA 4.0.](./LICENSE.md)

## Usage

Please see [Pieter Mostert's Glazy Data Analysis project](https://github.com/PieterMostert/glazy-data-analysis) to understand some of the challenges with using this data.

In particular, there are a number of duplicate recipes and similar recipes with only slight variations.

## Data Files

### legacy-data

This directory contains the original data used to seed the Glazy database.

### YAML

#### glazy-[DATE].yaml.gz

Compressed, human-readable YAML file that contains the all publicly archived materials and recipes in the Glazy database.

#### YAML format

The YAML file is a YAML objects representing materials, analyses, and recipes:
* ID: The Glazy ID of the material or recipe
* Parent ID: (Optional) Materials may have parent materials.  For example, the parent of Custer Feldspar is Potash Feldspar.
* Name: The name of the material or recipe
* Created By: The user who created the material or recipe.  Use ID to disambiguate users with the same name.
* Date Created: The date created in YYYY-MM-DD format
* Type: "Material", "Analysis", or "Recipe"
* Subtype: Subtype, e.g. "Glaze - Iron - Celadon - Green"
* Cone: The firing temperature in Orton cone numbers.  May be a range, e.g. "9 - 10"
* Surface: Surface type, e.g. "Glossy"
* Atmospheres: Array of atmospheres, e.g. [Reduction, Oxidation]
* Description: Description of the material or recipe
* Ingredients: Array of ingredients.  Each ingredient has an ID, Name, and Percentage.  If the ingredient is an additional ingredient, it will have an "Additional" field set to true.  The ID is the Glazy ID of the ingredient.
* Percent Analysis: Percent analysis of the material or recipe.  Each analysis has an oxide key (e.g. SiO2) and a value (e.g. 58.3003)

(UMF was not included, as there are differing opinions on how UMF should be unified.)

The following is an example of a simple material:
  
```
-
  ID: 15131
  Parent ID: 15371
  Name: "Custer Feldspar"
  Created By:
    Name: "Glazy Admin"
    ID: 1
  Date Created: 2015-07-16
  Type: Material
  Subtype: Feldspar
  Description: "Updated December 30, 2016. Analyses for recipes in Glazy using this material have automatically been updated..."
  Percent Analysis:
    SiO2: 68.5
    Al2O3: 17
    Na2O: 3
    K2O: 10
    CaO: 0.3
    Fe2O3: 0.1
    LOI: 0.3
```

The following is an example of a recipe:

```
-
  ID: 240
  Name: "Celadon Leach 4321"
  Created By:
    Name: "Glazy Admin"
    ID: 1
  Date Created: 1997-08-07
  Type: Recipe
  Subtype: Glaze - Iron - Celadon - Green
  Cone: 10
  Surface: Glossy
  Atmospheres: [Reduction]
  Description: "Glaze Type: Celadon The glaze that is as old as dirt. it is published in the leech book as old. Use 4% iron + or - depending on color / green to blue if you decorate..."
  Ingredients:
    -
      ID: 15142
      Name: "Feldspar"
      Percentage: 40
    -
      ID: 15400
      Name: "Silica"
      Percentage: 30
    -
      ID: 15457
      Name: "Whiting"
      Percentage: 20
    -
      ID: 15288
      Name: "Kaolin"
      Percentage: 10
    -
      ID: 15387
      Name: "Red Iron Oxide"
      Percentage: 4
      Additional: true
  Percent Analysis:
    SiO2: 58.3003
    Al2O3: 10.9119
    K2O: 6.509
    CaO: 10.7885
    Fe2O3: 3.6538
    LOI: 9.8365
```

### Legacy CSV

#### glazy-data-[TYPE]-[DATE].csv

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
