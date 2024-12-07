package com.example.demo2.farmerconnect;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
@Service
public class TargetUserService {
    @Autowired
    public UserDataBase userDataBase;

    public TargetUserDB targetUserDB = new TargetUserDB();

    public TargetUserService(){

    }
    public void saveTargetUser(TargetUser_T targetUser){
        this.targetUserDB.save_targetUser(targetUser);
    }

//    public List<TargetUser_T> getAllTheUsers() {
//        return targetUserDB.getAllTargetUser();
//    }

//     this code is found from upper codes ...
    public List<TargetUser_T> getAllTheUsers(){
        return  userDataBase.findAll();
      }
    public TargetUser_T getTargetUserByName(String user_name){
        return userDataBase.findByUserName(user_name);

    }

    public void addUser(TargetUser_T targetUser) {
        this.targetUserDB.save_targetUser(targetUser);
    }
}
