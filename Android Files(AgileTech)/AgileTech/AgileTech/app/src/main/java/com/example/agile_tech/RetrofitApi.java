package com.example.agile_tech;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface RetrofitApi {

    @FormUrlEncoded
    @POST("Register&login/Registration.php ")
    Call<DataModal> createPost(
            @Field("FirstName") String first_name,
            @Field("LastName") String last_name,
            @Field("Contact") String contact,
            @Field("Email") String email,
            @Field("Password") String password
    );


    @GET("Register&login/login.php ")
    Call<logindatamodal> login(
            @Query("Login_Email") String login_email,
            @Query("Login_Password") String login_password
    );


    @GET("Attendance/Attendance.php")
    Call<DataModal> location(
            @Query("Latitude") String latitude,
            @Query("Longitude") String longitude
    );

    @FormUrlEncoded
    @POST("Attendance/put_Attendance.php")
    Call<DataModal> put_Attendance(
            @Field("radio") String radio
    );

    @GET("Attendance/get_Attendance.php")
    Call<List<AttendanceModal>> get_Attendance();


    @GET("Register&login/Logout.php ")
    Call<DataModal> logout();

    @FormUrlEncoded
    @POST("Register&login/setsession.php")
    Call<DataModal> user_id(
            @Field("U_ID") String U_ID
    );
}
