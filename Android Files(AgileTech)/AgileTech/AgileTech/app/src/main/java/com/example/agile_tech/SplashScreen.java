package com.example.agile_tech;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.view.WindowManager;
import android.widget.Toast;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class SplashScreen extends AppCompatActivity {

    private static final long SPLASH_SCREEN_TIME_OUT = 2000;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
                WindowManager.LayoutParams.FLAG_FULLSCREEN);
        //This method is used so that your splash activity
        //can cover the entire screen.
        setContentView(R.layout.activity_splash_screen);
        new Handler().postDelayed(new Runnable() {
            @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
            @Override
            public void run() {

                SharedPreferences sh = getSharedPreferences("MySharedPref", MODE_PRIVATE);
                String U_ID = sh.getString("ID", "");
                if (U_ID.equals("")) {
                    Intent i = new Intent(SplashScreen.this,
                            MainActivity.class);
                    startActivity(i);
                    finish();
                } else {
                    RetrofitApi retrofit = apiclient.getApi();
                    Call<DataModal> user_id = retrofit.user_id(U_ID);
                    user_id.enqueue(new Callback<DataModal>() {
                        @Override
                        public void onResponse(Call<DataModal> call, Response<DataModal> response) {
//                            Toast.makeText(SplashScreen.this, response.body().response, Toast.LENGTH_SHORT).show();
                            if (response.body().response.equals("reset")) {
                                Intent intent2 = new Intent(SplashScreen.this, MainActivity.class);
                                startActivity(intent2);
                                finish();
                            } else {
                                Toast.makeText(SplashScreen.this, "Unable to connect to server ,Please  try again", Toast.LENGTH_SHORT).show();
                                finish();
                            }
                        }

                        @Override
                        public void onFailure(Call<DataModal> call, Throwable t) {
                            Toast.makeText(SplashScreen.this, t.toString(), Toast.LENGTH_SHORT).show();
                        }
                    });

                }
                //Intent is used to switch from one activity to another.


                //invoke the SecondActivity.


                finish();
                //the current activity will get finished.
            }
        }, SPLASH_SCREEN_TIME_OUT);


    }
}