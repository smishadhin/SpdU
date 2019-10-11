package com.shovan.ars.imagetotextreaderall;
import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.DialogInterface;
import android.content.Intent;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.MediaController;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.VideoView;

import java.util.Calendar;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {


    public static boolean FragmentFlag=true;
    Internet_Connection_Checker checker;

    Connection_Database CD;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);


        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

       CD= new Connection_Database();

        checker=new Internet_Connection_Checker(MainActivity.this);
        setFragment();
        if (android.os.Build.VERSION.SDK_INT > 9) {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                    .permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }
    }


    public void setFragment() {

        Fragment fragment;
        if (FragmentFlag == true) {

            fragment = new ImageToTextFragment();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment, fragment);
            ft.commit();
        } else if (FragmentFlag == false) {

            fragment = new SaveDataFragment();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment, fragment);
            ft.commit();
            FragmentFlag=true;
        }
    }





    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            this.finish();
            super.onBackPressed();
        }
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.nav_main_page) {
            // Handle the camera action
        } else if (id == R.id.nav_save_data) {

        } else if (id == R.id.nav_help) {

        } else if (id == R.id.nav_about_us) {

        } else if (id == R.id.nav_feedback) {

        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        Fragment fragment;
        if (id == R.id.nav_main_page) {
            fragment = new ImageToTextFragment();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment, fragment);
            ft.commit();
        } else if (id == R.id.nav_save_data) {
            fragment = new SaveDataFragment();
            FragmentManager fm = getFragmentManager();
            FragmentTransaction ft = fm.beginTransaction();
            ft.replace(R.id.fragment, fragment);
            ft.commit();

        } else if (id == R.id.nav_help) {

            final AlertDialog.Builder alert = new AlertDialog.Builder(MainActivity.this);
            final CharSequence[] items = { "Read", "Video" };
            alert.setSingleChoiceItems(items, -1,
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int item) {
                            switch (item){
                                case 0:
                                    AlertDialog.Builder alertDialogRead=new AlertDialog.Builder(MainActivity.this);
                                    alertDialogRead.setCancelable(false);
                                    alertDialogRead.setTitle("Help");
                                    alertDialogRead.setMessage("Details");
                                    alertDialogRead.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                                        @Override
                                        public void onClick(DialogInterface dialogInterface, int i) {
                                            dialogInterface.dismiss();
                                        }
                                    });
                                    alertDialogRead.show();

                                    dialog.dismiss();
                                    break;
                                case 1:



                                    if (checker.isConnected()) {
                                        final MediaController mediacontroller;
                                        final Uri uri;
                                        final boolean[] isContinuously = {false};
                                        final boolean[] flag = {true};

                                        AlertDialog.Builder dialogBuilder = new AlertDialog.Builder(MainActivity.this);
                                        LayoutInflater inflater = MainActivity.this.getLayoutInflater();
                                        View dialogView = inflater.inflate(R.layout.dialog_view, null);
                                        dialogBuilder.setView(dialogView);
                                        dialogBuilder.setCancelable(false);

                                        final Button buttonStart = (Button) dialogView.findViewById(R.id.buttonStart);
                                        final ProgressBar progressBar = (ProgressBar) dialogView.findViewById(R.id.progrss);
                                        final VideoView vv = (VideoView) dialogView.findViewById(R.id.vv);

                                        mediacontroller = new MediaController(MainActivity.this);
                                        mediacontroller.setAnchorView(vv);
                                        String uriPath = "http://www.slasstec.com/androidimagetest/small.mp4"; //update package name
                                        uri = Uri.parse(uriPath);


                                        vv.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {
                                            @Override
                                            public void onCompletion(MediaPlayer mp) {
                                                if (isContinuously[0]) {
                                                    vv.start();
                                                }
                                            }
                                        });

                                        buttonStart.setOnClickListener(
                                                new View.OnClickListener() {
                                                    @Override
                                                    public void onClick(View view) {

                                                        buttonStart.setText("Play Again");
                                                        isContinuously[0] = true;
                                                        progressBar.setVisibility(View.VISIBLE);
                                                        vv.setMediaController(mediacontroller);
                                                        vv.setVideoURI(uri);
                                                        vv.requestFocus();
                                                        vv.start();
                                                        flag[0] = false;
                                                    }
                                                }
                                        );


                                        vv.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
                                            // Close the progress bar and play the video
                                            public void onPrepared(MediaPlayer mp) {
                                                progressBar.setVisibility(View.GONE);
                                            }
                                        });

                                        vv.setOnClickListener(
                                                new View.OnClickListener() {
                                                    @Override
                                                    public void onClick(View view) {
                                                        if (flag[0] == false) {
                                                            vv.pause();
                                                            flag[0] = true;
                                                        } else {
                                                            vv.start();
                                                            flag[0] = false;
                                                        }

                                                    }
                                                }
                                        );


                                        dialogBuilder.setPositiveButton("Close", new DialogInterface.OnClickListener() {
                                            @Override
                                            public void onClick(DialogInterface dialogInterface, int i) {
                                                vv.pause();
                                                dialogInterface.dismiss();
                                            }
                                        });


                                        dialogBuilder.show();


                                        dialog.dismiss();
                                    }else {
                                        Toast.makeText(MainActivity.this, "Need Internet", Toast.LENGTH_SHORT).show();
                                    }
                                    break;
                            }

                        }
                    });

            alert.setTitle("About Us :");
            alert.setCancelable(true);

            alert.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {
                    dialogInterface.dismiss();
                }
            });
            alert.show();


        } else if (id == R.id.nav_about_us) {

            final AlertDialog.Builder alert = new AlertDialog.Builder(MainActivity.this);
            LinearLayout layout = new LinearLayout(MainActivity.this);
            layout.setOrientation(LinearLayout.VERTICAL);
            layout.setPadding(45,45,45,45);

            final TextView textView = new TextView(MainActivity.this);
            textView.setText("Visit Our Website !\n\nwww.slasstec.com\n");
            layout.addView(textView);


            alert.setView(layout);
            alert.setTitle("About Us :");
            alert.setCancelable(true);
            alert.setPositiveButton("Visit", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {
                    Uri uri = Uri.parse("http://www.slasstec.com"); // missing 'http://' will cause crashed
                    Intent intent = new Intent(Intent.ACTION_VIEW, uri);
                    startActivity(intent);
                    dialogInterface.dismiss();
                }
            });

            alert.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {

                    dialogInterface.dismiss();
                }
            });
            alert.show();


        } else if (id == R.id.nav_feedback) {
            if (checker.isConnected()){

                final AlertDialog.Builder alert = new AlertDialog.Builder(MainActivity.this);
                LinearLayout layout = new LinearLayout(MainActivity.this);
                layout.setOrientation(LinearLayout.VERTICAL);
                layout.setPadding(45,45,45,45);

                final EditText editTextTitle = new EditText(MainActivity.this);
                editTextTitle.setHint("Title");
                layout.addView(editTextTitle);

                final EditText editTextDetails = new EditText(MainActivity.this);
                editTextDetails.setHint("Details");
                layout.addView(editTextDetails);

                alert.setView(layout);
                alert.setTitle("Feedback : ");
                alert.setCancelable(false);
                alert.setPositiveButton("Submit", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                        if (!editTextDetails.getText().toString().equals("")) {

                            CD.insert(editTextTitle.getText().toString().replace(" ","_"),
                                    editTextDetails.getText().toString().replace(" ","_"),getDateTime().replace(" ","-").replace(":","-"));
                            dialogInterface.dismiss();
                            Toast.makeText(MainActivity.this, "Your Feedback Send", Toast.LENGTH_SHORT).show();
                        }else {
                            Toast.makeText(MainActivity.this, "Enter Your Feedback", Toast.LENGTH_SHORT).show();
                        }

                    }
                });

                alert.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                        dialogInterface.dismiss();
                    }
                });
                alert.show();
            }else {
                Toast.makeText(MainActivity.this, "Need Internet", Toast.LENGTH_SHORT).show();
            }


        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


    private String getDateTime(){
        int YYear, MMonth, DDay;

        Calendar calendar = Calendar.getInstance();
        YYear = calendar.get(Calendar.YEAR);
        MMonth = calendar.get(Calendar.MONTH) + 1;
        DDay = calendar.get(Calendar.DAY_OF_MONTH);


        String y = String.valueOf(YYear);
        String m = "";
        if (MMonth < 10) {
            m = "0" + String.valueOf(MMonth);
        } else {
            m = String.valueOf(MMonth);
        }
        String d = "";
        if (DDay < 10) {
            d = "0" + String.valueOf(DDay);
        } else {
            d = String.valueOf(DDay);
        }

        String Date = (y + "-" + m + "-" + d ).toString();


        int Hour=calendar.get(Calendar.HOUR);
        int Minute=calendar.get(Calendar.MINUTE);

        String h="";
        if (Hour<10){
            h = "0"+String.valueOf(Hour);
        }else {
            h = String.valueOf(Hour);
        }
        String mi="";
        if (Minute<10){
            mi = "0"+String.valueOf(Minute);
        }else {
            mi = String.valueOf(Minute);
        }

        String Time=(h + ":" + mi).toLowerCase();

        return Date+" "+Time;
    }
}
