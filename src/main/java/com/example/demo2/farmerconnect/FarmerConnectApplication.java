package com.example.demo2.farmerconnect;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ConfigurableApplicationContext;

import java.util.List;

@SpringBootApplication
public class FarmerConnectApplication {


    public static void main(String[] args) {
        ConfigurableApplicationContext context = SpringApplication.run(FarmerConnectApplication.class, args);
        TargetUserService targetUserService = context.getBean(TargetUserService.class);
        AnalystService analystService = new AnalystService();


//        targetUserService.saveTargetUser(new TargetUser_T("rang01",1716115335,"19237g","saif","farmer"));

        // entering data to database
//        analystService.saveMarketPriceAndRates(new AnalystMarketPriceAndAdvisedRates_T("rang20","C00002", "good","not good",20,52,49,"due to rain"));

        // getting data from targetUser
        List <TargetUser_T> userDataList = targetUserService.getAllTheUsers();
        for (TargetUser_T user : userDataList) {
            System.out.println(user.toString());
        }
        // getting data from market prices
        List <AnalystMarketPriceAndAdvisedRates_T> allMarketPrice = analystService.showMarketPriceAndRates();
        for (AnalystMarketPriceAndAdvisedRates_T marketData : allMarketPrice) {
            System.out.println(marketData.toString());
        }


    }
}