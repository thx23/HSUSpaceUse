# SpaceUse
SpaceUse is an open-source web application that can be used to collect data on how user/customers use a particular area, floor, room or building with ease. It was designed to streamline the process of collecting and calculating data on customers actions while using a specific facility. We designed SpaceUse to work across different browser as well as on touch screen devices.

SpaceUse has the ability to compile all the data that gets collected in an easily readable fashion, whether that is in text format or visually on a map of the specific area. Users of SpaceUse have the ability to add new floor plans, add new activities for the furniture, add new layouts for each floor plan and more. 

## Getting Started
SpaceUse was developed on a XAMPP technology stack so set up on any server that uses XAMPP is a breeze.
   - Just download the source folder in the repository and paste the files into the public_html (or the equivalent) folder. 
Setting up the database:
   - Open design->database->scripts
   - In this location, you will find all of the scripts to run and set up the database to be used for the first time
   - Run the scripts in this order
      1. LAdesign.sql
      2. room_populate.sql
      3. area_populate.sql
      4. furniture_type_populate.sql
      5. furniture_L1.sql
      6. furniture_L2.sql
      7. furniture_L3.sql
      8. update L1.sql (located in updateScriptsForFloorLayout)
      9. update L2.sql (located in updateScriptsForFloorLayout)
      10. update L3.sql (located in updateScriptsForFloorLayout)
      11. activity_populate.sql
 
#### Deployment Notes
To get the Upload functionality working you might have to change the path for the images folder to the correct path for your server, you can find this file in source/upload-floor.php on line 61.

## Built With
[LeafLet.js](https://leafletjs.com/) - JavaScript plug-in used to make the map.
[JQuery](https://jquery.com/) and [JQueryUI](https://jqueryui.com/)

## Authors
* **Sam Alston** 
* **Eric Mott**
* **Ben Miller**

## Acknowledgements
* From everyone of the SpecaUse team, we would like to thank the Humboldt State University Library staff, as well as, Kris Anderson for the help and support throughout the project.

## Contents

### Design
Contains Concepts and structure overview including database design.

### TeamCommunication
Stores links to communication hubs for the team.

### source
Contains current build of project.

### License
The license of this product.
