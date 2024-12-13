package com.example.demo2.farmerconnect;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

@Controller
public class Agent_Controller {

    @GetMapping("/agent_area_insertion")
    public String Agent_Area_insert_form() {
        return "Agent_Area_insert_form";
    }
}
