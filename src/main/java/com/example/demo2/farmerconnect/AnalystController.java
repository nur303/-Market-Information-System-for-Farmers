package com.example.demo2.farmerconnect;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class AnalystController {

    @GetMapping("/analyst_dashboard")
    public String getAnalyst() {
        return "analyst_dashboard";
    }
    @GetMapping("/analyst_advised_rates")
    public String advised_rates() {
        return "analyst_advised_rates";
    }
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


}
