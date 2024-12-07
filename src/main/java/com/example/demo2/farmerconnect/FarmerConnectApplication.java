package com.example.demo2.farmerconnect;

import org.apache.catalina.core.ApplicationContext;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ConfigurableApplicationContext;

import java.util.List;

@SpringBootApplication
public class FarmerConnectApplication {


    public static void main(String[] args) {
        ConfigurableApplicationContext context = SpringApplication.run(FarmerConnectApplication.class, args);
        TargetUserService targetUserService = context.getBean(TargetUserService.class);

//        targetUserService.saveTargetUser(new TargetUser_T("rang01",1716115335,"19237g","saif","farmer"));
        List <TargetUser_T> userDataList = targetUserService.getAllTheUsers();
        for (TargetUser_T user : userDataList) {
            System.out.println(user.toString());
        }

    }
}