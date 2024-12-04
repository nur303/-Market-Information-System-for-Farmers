package com.example.demo2.farmerconnect;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;

import java.util.List;
@Controller
public class FarmerController {
    @Autowired
     TargetUserService targetUserService;

    @ModelAttribute("userDataList")
    public List<TargetUser_T> userNames() {
        return targetUserService.getAllTheUsers();
    }
    @GetMapping("/farmer")
    public String getAllFarmers() {
        return "Farmer"; // This is the name of the HTML page that will display the data
    }

    @GetMapping("/analyst")
    public String getAnalyst() {
        return "analystDashboard";
    }

}
