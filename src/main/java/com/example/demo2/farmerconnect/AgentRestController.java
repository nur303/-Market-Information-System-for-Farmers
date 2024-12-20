package com.example.demo2.farmerconnect;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;

import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Map;

import static java.lang.Integer.parseInt;

@RestController
public class AgentRestController {
    AreaDB areaDB= new AreaDB();
    Area_T areaT= new Area_T();
    Crop_T cropT= new Crop_T();
    CropDB cropDB= new CropDB();
    User_T userT= new User_T();
    UserDB userDB= new UserDB();
    Harvest_T harvest = new Harvest_T();
    HarvestDB harvestDB= new HarvestDB();
    @PostMapping("/api/AreaInsertion")
    public ResponseEntity<String> handleFormSubmission(@RequestBody Map<String,Object > payload) {
        try {

            String area_code = (String) payload.get("areaCode");
            String area_name = (String) payload.get("areaLocation");
            areaT.setArea_code(area_code);
            areaT.setArea_location(area_name);


            if (area_code != null && area_code.length() == 6) {
                areaDB.save_area_data(areaT);
                return ResponseEntity.ok("Area inserted successfully!");
            } else {
                // Explicitly return a 400 status with an error message
                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Invalid area code! Area code must be exactly 6 characters long.");
            }
        } catch (Exception e) {

            return ResponseEntity.status(500).body("Failed to save data.");
        }


    }

/// ////////       crop insertion    //////////////
        @PostMapping("/api/CropInsertion")
        public ResponseEntity<String> handleCropSubmission(@RequestBody Map<String,Object > payload) {
            try {

                String cropID = (String) payload.get("cropID");
                String crop_name = (String) payload.get("cropName");
                String season = (String) payload.get("season");

                cropT.setCropID(cropID);
                cropT.setSeason(season);
                cropT.setCrop_name(crop_name);
//                System.out.println(cropT.toString());

                if (cropID != null && cropID.matches("^[A-Za-z0-9]{6}$")) {
                    cropDB.save_crop_data(cropT);
                    return ResponseEntity.ok("Data saved successfully!");
                }
                else {
                    // Explicitly return a 400 status with an error message
                    return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Invalid area code! Area code must be exactly 6 characters long.");
                }
            }
            catch (Exception e) {

                return ResponseEntity.status(500).body("Failed to save data.");
            }

        }


        /// ///////////  deleting crop  data  ////////////////
    @GetMapping("/agent/all_crops")
    public ResponseEntity<List<Crop_T>> getAllCrops() {
        return ResponseEntity.ok(cropDB.showAllCropData());
    }
    @DeleteMapping("/agent/delete-crop")
    public ResponseEntity<String> deleteCropInfo(@RequestBody Map<String, Object> payload) {
        try {
            // Extract necessary parameters from the payload
//            String updateDate = (String) payload.get("updateDate");

            // Print the date to the console
//            System.out.println("Received Update Date: " + updateDate);
            String cropID = (String) payload.get("cropID");
            System.out.println(cropDB.deleteData(cropID));
            return ResponseEntity.ok("Record deleted successfully!");
        } catch (Exception e) {
            e.printStackTrace();
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Failed to delete the record.");
        }
    }

    //////////////////   farmer insertion  //////////////
    @PostMapping("/agent/register-farmer")
    public ResponseEntity<String> handleFarmerSubmission(@RequestBody Map<String,Object > payload) {
        try {

            String userName = (String) payload.get("userName");
            String phoneNumber = (String) payload.get("phoneNumber");
            if(phoneNumber.length()  != 11){
                return ResponseEntity.status(500).body("Correct the phone number length");
            }
            String area_code = (String) payload.get("location");
            String userType =  (String) payload.get("userType");
            String education = (String) payload.get("educationLevel");
            String shopNumber = (String) payload.get("shopNumber");
            String cropID = (String) payload.get("crop");
            userT.setUserName(userName);
            try {
                userT.setPhoneNumber(parseInt(phoneNumber));
            }catch (Exception e){
                return ResponseEntity.status(500).body("Invalid phone number");
            }
            userT.setAreaCode(area_code);
            userT.setUserType(userType);
            userT.setEducationLevel(education);
            userT.setShopNumber(shopNumber);
            userT.setCropID(cropID);

                System.out.println(userT.toString());
            userDB.save_user_in_targetUSer(userT);
//            if (cropID != null && cropID.matches("^[A-Za-z0-9]{6}$")) {
//                cropDB.save_crop_data(cropT);
                return ResponseEntity.ok("Data saved successfully!");
//            }
//            else {
//                // Explicitly return a 400 status with an error message
//                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Invalid area code! Area code must be exactly 6 characters long.");
//            }
        }
        catch (Exception e) {

            return ResponseEntity.status(500).body("Failed to save data.");
        }

    }

    ///////////// harvestT insertion  ///////////////////////
    @PostMapping("/api/harvest_insert")
    public ResponseEntity<String> handleHarvestSubmission(@RequestBody Map<String,Object > payload) {
        try {

            String farmerID = (String) payload.get("farmerID");
//            System.out.println(farmerID);
            String CROPid = (String) payload.get("crop");

            String area_code = (String) payload.get("location");
            String inStock =  (String) payload.get("inStock");
//            System.out.println(inStock);
            String quantity = (String) payload.get("quantity");
            String quality = (String) payload.get("quality");
            String askingPrice = (String) payload.get("askingPrice");


            harvest.setFarmerID(parseInt(farmerID));
            harvest.setCropID(CROPid);
            harvest.setArea_code(area_code);
            harvest.setInStock(parseInt(inStock));
            harvest.setQuantity(parseInt(quantity));
            harvest.setQuality(quality);
            harvest.setAskingPrice(parseInt(askingPrice));

//
//            System.out.println(harvest.getHarvestId());
            System.out.println(harvest.toString());
            System.out.println(harvest.getInStock());
            harvestDB.save_harvest_data(harvest);
//            if (cropID != null && cropID.matches("^[A-Za-z0-9]{6}$")) {
//                cropDB.save_crop_data(cropT);
            return ResponseEntity.ok("Data saved successfully!");
//            }
//            else {
//                // Explicitly return a 400 status with an error message
//                return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Invalid area code! Area code must be exactly 6 characters long.");
//            }
        }
        catch (Exception e) {

            return ResponseEntity.status(500).body("Failed to save data.");
        }

    }

    /// //      all harvest info showing in table  //////
    @GetMapping("/agent/all_harvests")
    public ResponseEntity<List<Harvest_T>> getHarvestInfoForAgent() {
        return ResponseEntity.ok(harvestDB.get_all_harvest_data());
    }


    ///  delete a harvest Info  ////
    @DeleteMapping("/agent/analyst/delete-harvest")
    public ResponseEntity<String> deleteHarvestInfo(@RequestBody Map<String,Object> payload) {

        int harvestID = parseInt((String) payload.get("harvestID"));
        try {

            // Extract necessary parameters from the payload
            System.out.println(harvestID);;

//             Print the date to the console
//            System.out.println("Received Update Date: " + updateDate);

            // Perform the deletion using the repository
            boolean response = harvestDB.deleteData(harvestID);
            System.out.println(response);
            return ResponseEntity.ok("Record deleted successfully!");
        } catch (Exception e) {
            e.printStackTrace();
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Failed to delete the record.");
        }
    }
}


