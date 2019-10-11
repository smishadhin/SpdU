package com.example.shovan21.hackaton;

import android.content.Intent;
import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;


public class Login extends Fragment {
Button buttonLogin,buttonForget;
    EditText editTextID,editTextPass;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        final View RootView= inflater.inflate(R.layout.fragment_login, container, false);

        editTextID= (EditText) RootView.findViewById(R.id.editTextID);
        editTextPass= (EditText) RootView.findViewById(R.id.editTextPassword);


        buttonLogin=(Button)RootView.findViewById(R.id.buttonLogin);
        buttonLogin.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        String id=editTextID.getText().toString().toLowerCase();
                        String pss=editTextPass.getText().toString().toLowerCase();
                        if (id.equals(pss)) {
                            Intent intent = new Intent(getActivity().getApplicationContext(), Login_InfoActivity.class);
                            startActivity(intent);
                        }
                    }
                }
        );

        buttonForget=(Button)RootView.findViewById(R.id.buttonForgetPassword);
        buttonForget.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {

                            Intent intent = new Intent(getActivity().getApplicationContext(), FotgetPasswordActivity.class);
                            startActivity(intent);

                    }
                }
        );
        return RootView;
    }

}
