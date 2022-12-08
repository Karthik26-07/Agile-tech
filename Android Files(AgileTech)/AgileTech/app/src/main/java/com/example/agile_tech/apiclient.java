package com.example.agile_tech;

import android.os.Build;

import androidx.annotation.RequiresApi;

import java.net.CookieHandler;
import java.net.CookieManager;
import java.util.concurrent.TimeUnit;

import okhttp3.JavaNetCookieJar;
import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

@RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)
public class apiclient {

    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP_MR1)

    static HttpLoggingInterceptor interceptor = new HttpLoggingInterceptor();
    static CookieHandler cookieHandler = new CookieManager();
    static OkHttpClient client = new OkHttpClient.Builder().addNetworkInterceptor(interceptor)
            .cookieJar(new JavaNetCookieJar(cookieHandler))
            .connectTimeout(10, TimeUnit.SECONDS)
            .writeTimeout(10, TimeUnit.SECONDS)
            .readTimeout(30, TimeUnit.SECONDS)
            .build();

    public static RetrofitApi getApi() {
        Retrofit retrofit = new Retrofit.Builder()
                .addConverterFactory(GsonConverterFactory.create())
                .baseUrl("http:192.168.1.4:80/Agiletech/")
                .client(client)
                .build();
        RetrofitApi api = retrofit.create(RetrofitApi.class);
        return api;
    }
}


