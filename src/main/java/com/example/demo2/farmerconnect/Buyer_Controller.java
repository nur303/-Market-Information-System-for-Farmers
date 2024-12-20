package com.example.demo2.farmerconnect;


import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class Buyer_Controller {

    @GetMapping("/buyer_harvest_bid_option")
    public String graph() {
        return "buyer_harvest_bid_option";
    }
}
