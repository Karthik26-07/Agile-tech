package com.example.agile_tech;

import com.google.gson.annotations.SerializedName;

import java.io.Serializable;

public class logindatamodal implements Serializable {
@SerializedName("response")
 public String response;
@SerializedName("email")
    public String Email;
@SerializedName("name")
    public String Name;
@SerializedName("id")
    public String Id;
}
