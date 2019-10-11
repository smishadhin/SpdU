package com.company;

public class Main {
    static int s[] = {1,3,2,4};
    static int n =s.length;
    static int v[] = {2,7,6,10};
    static int S = 5;

    static int dynamicKnapsac( int S,int s[],int v[], int n){
         int V[][] = new int[n+1][S+1];
        for (int i=0;i<=n;i++){
            for (int s1=0;s1<=S;s1++){
                if (i==0 || s1==0){
                    V[i][s1] = 0;
                }else if (s[i-1]<=s1){
                    if (v[i-1]+V[i-1][s1-s[i-1]]>V[i-1][s1]){
                        V[i][s1] = v[i-1]+V[i-1][s1-s[i-1]];
                    }else {
                        V[i][s1]=V[i-1][s1];
                    }
                }else {
                    V[i][s1] = V[i-1][s1];
                }
            }
        }

        //////////backtrac//////////

        int i=n;
        int k = S;
        while (i >0 || k > 0){
            if (V[i][k]!=V[i-1][k]){
                i=i-1;
                k =k-s[i];
                System.out.println(i);
            }else {
                i = i-1;
               // System.out.println(i);
            }
        }

        return V[n][S];
    }
    public static void main(String[] args) {

        System.out.println(dynamicKnapsac(S,s,v,n));

    }
}
