package com.example.demo2.farmerconnect;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;

import java.util.List;

@Controller
public class AnalystController {
    @Autowired
    AnalystService analystService;

    @GetMapping("/analyst_dashboard")
    public String getAnalyst() {return "analyst_dashboard";}

    @GetMapping("/analyst_input_market_data")
    public String advised_rates() {return "analyst_input_for_market_price";}

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
    @ModelAttribute("marketPrices")
    public List<AnalystMarketPriceAndAdvisedRates_T> allMarketData() {

        return analystService.showMarketPriceAndRates();
}
}
