package com.shovan.ars.imagetotextreaderall;

import android.app.Service;
import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

/**
 * Created by arssh on 12-Jun-17.
 */

public class Internet_Connection_Checker {

    Context context;

    public Internet_Connection_Checker(Context context){
        this.context=context;
    }

    public boolean isConnected(){
        ConnectivityManager connectivityManager= (ConnectivityManager) context.getSystemService(Service.CONNECTIVITY_SERVICE);
        if (connectivityManager!=null){
            NetworkInfo info=connectivityManager.getActiveNetworkInfo();
            if (info!=null){
                if (info.getState()==NetworkInfo.State.CONNECTED){
                    return  true;
                }
            }
        }
        return false;
    }

}
