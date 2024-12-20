package com.example.demo2.farmerconnect;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;

import java.util.List;

@Controller
public class Agent_Controller {
    AreaDB areaDB = new AreaDB();
    CropDB cropDB = new CropDB();
    UserDB userDB = new UserDB();
    HarvestDB harvestDB = new HarvestDB();

    @GetMapping("/agent_area_insertion")
    public String Agent_Area_insert_form() {
        return "Agent_Area_insert_form";
    }
    @GetMapping("/agent_harvest_insertion")
    public String Agent_Harvest_insert_form() {
        return "Agent_Harvest_insert_form";
    }
    @GetMapping("/agent_crop_insertion")
    public String Agent_crop_insert_form() {
        return "Agent_Crop_insert_form";
    }
    @GetMapping("agent_crop_info_table")
    public String Agent_crop_information() {
        return "Agent_Crop_info_table";
    }
    @GetMapping("agent_user_insert_form")
        public String Agent_user_insert_form() {
        return "Agent_User_insert_form";
        }
    @GetMapping("/agent_All_Harvest")
    public String Agent_All_Harvest() {
        return "All_Harvest_view";
    }
    @GetMapping("/agent_bids_info")
    public String Agent_bids_info() {
        return "view_all_bids_of_buyer";
    }
    @GetMapping("/buyer_dashboard")
    public String buyer() {
        return "buyer_dashboard";
    }

    @ModelAttribute("locations")
    public List<Area_T> allLocations() {
        return areaDB.showAllAreaData();
    }
    @ModelAttribute("crops")
    public List<Crop_T> allCrops() {
        return cropDB.showAllCropData();
    }
    @ModelAttribute("farmers")
    public List<User_T> allFarmerID() {
        return userDB.showAllFarmerData();
    }



}
