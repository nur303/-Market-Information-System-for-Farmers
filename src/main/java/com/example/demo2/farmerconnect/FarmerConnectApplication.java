package com.example.demo2.farmerconnect;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ConfigurableApplicationContext;

import java.util.List;

@SpringBootApplication
public class FarmerConnectApplication {


    public static void main(String[] args) {
        ConfigurableApplicationContext context = SpringApplication.run(FarmerConnectApplication.class, args);
        HarvestDB harvestDB  = new HarvestDB();
        AnalystService analystService = new AnalystService();
        BidDB bidDB = new BidDB();
        UserDB userDB = new UserDB();
//        for(User_T userT : userDB.showAllFarmerData()){
//            System.out.println(userT.getUserID());
//        }

        for(Bid_T bid_t : bidDB.get_all_Bids_data()){
            System.out.println(bid_t.toString());
        }
//        for (User_T user : bidDB.get_all_buyer_data()){
//            System.out.println(user.getUserName());
//        }
//        for(Harvest_T harvest :harvestDB.get_all_harvest_data() ){
//            System.out.println(harvest.toString());
//        }



//        targetUserService.saveTargetUser(new TargetUser_T("rang01",1716115335,"19237g","saif","farmer"));

        // entering data to database
//        analystService.saveMarketPriceAndRates(new AnalystMarketPriceAndAdvisedRates_T("rang20","C00002", "good","not good",20,52,49,"due to rain"));

        // getting data from targetUser

        // getting data from market prices
        List <AnalystMarketPriceAndAdvisedRates_T> allMarketPrice = analystService.showMarketPriceAndRates();
        for (AnalystMarketPriceAndAdvisedRates_T marketData : allMarketPrice) {
            System.out.println(marketData.toString());
        }


    }
}