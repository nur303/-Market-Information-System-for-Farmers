package com.example.demo2.farmerconnect;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;

import java.util.List;

@Controller
public class TargetUserController {
    @Autowired
    TargetUserService targetUserService;


    @GetMapping("/TargetUser")
    public List<TargetUser_T> getAllUsers(){
        return targetUserService.getAllTheUsers();
    }
    @GetMapping( "/TargetUser/{userName}")
    public TargetUser_T getUserByName(@PathVariable String userName){

        return targetUserService.getTargetUserByName(userName);
    }

    @PostMapping("/TargetUser")
    public void addUser(TargetUser_T user){

        targetUserService.addUser(user);
    }

// start showing data in HTML :
    @ModelAttribute("userDataList")
    public List<TargetUser_T> userNames() {
        return targetUserService.getAllTheUsers();
    }

    @GetMapping("/targetUsers")
    public String getAllTargetUsers() {
        return "TargetUser"; // This is the name of the HTML page that will display the data
    }



}

