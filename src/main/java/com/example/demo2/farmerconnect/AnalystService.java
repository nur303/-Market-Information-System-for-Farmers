package com.example.demo2.farmerconnect;

import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class AnalystService {
    AnalystDB analystDB = new AnalystDB();
    public AnalystService() {
    }
    public void saveMarketPriceAndRates(AnalystMarketPriceAndAdvisedRates_T advisedRates){
        analystDB.save_market_data(advisedRates );
    }
    public List<AnalystMarketPriceAndAdvisedRates_T> showMarketPriceAndRates(){
        return analystDB.showAllMarketData();
    }
}
