package com.example.demo2.farmerconnect;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
public class AnalystController {
    @Autowired
    AnalystService analystService;

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

// modeling attribute
    // showing all market price
    @ModelAttribute("marketPrices")
    public List<AnalystMarketPriceAndAdvisedRates_T> allMarketData() {

        return analystService.showMarketPriceAndRates();

    // showing all crop, area as option graphs and charts

    }
    @ModelAttribute("locations")
    public List<Area_T> allLocations() {
        return areaDB.showAllAreaData();
    }
    @ModelAttribute("crops")
    public List<Crop_T> allCrops() {
        return cropDB.showAllCropData();
    }




}
