package com.example.demo2.farmerconnect;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
public class AnalystController {
    @Autowired
    AnalystService analystService;
    AnalystDB analystDB = new AnalystDB();
    AreaDB areaDB = new AreaDB();
    CropDB cropDB = new CropDB();

    @GetMapping("/analyst_dashboard")
    public String getAnalyst() {return "analyst_dashboard";}



    @GetMapping("/analyst_graph_chart")
    public String graph() {
        return "analyst_graph_chart";
    }

    @GetMapping("/analyst_market_prices")
    public String market_prices() {
        return "analyst_market_prices";
    }

    @GetMapping("/analyst_index")
    public String index() {
        return "analyst_index";
    }
    @GetMapping("/analyst_input_market_data")
    public String advised_rates() {return "analyst_input_for_market_price";}
//    @GetMapping("/agent_All_Harvest")
//    public String Agent_All_Harvest() {
//        return "All_Harvest_view";
//    }


// modeling attribute

    @ModelAttribute("locations")
    public List<Area_T> allLocationsForInputForm() {
            return areaDB.showAllAreaData();
        }


    @ModelAttribute("crops")
    public List<Crop_T> allCropsForInputForm() {
        return cropDB.showAllCropData();
        }

        // showing all crop, area as option graphs and charts


    @ModelAttribute("locations")
    public List<Area_T> allLocations() {
        return areaDB.showAllAreaData();
    }
    @ModelAttribute("crops")
    public List<Crop_T> allCrops() {
        return cropDB.showAllCropData();
    }


}
