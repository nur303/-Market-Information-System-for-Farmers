package com.example.demo2.farmerconnect;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.List;

@Controller
public class agentController {
    AreaDB areaDB = new AreaDB();
    CropDB cropDB = new CropDB();

    @GetMapping("/agent_input_market_data")
    public String advised_rates() {return "agent_input_for_market_price";}
    @ModelAttribute("locations")
    public List<Area_T> allLocations() {
        return areaDB.showAllAreaData();
    }
    @ModelAttribute("crops")
    public List<Crop_T> allCrops() {
        return cropDB.showAllCropData();
    }

    @PostMapping()
}
