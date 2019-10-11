/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package uplodtst;



/**
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
public class Uplodtst {
Thread t;
    /**
     * @param args the command line arguments
     * @throws java.lang.InterruptedException
     */
    public static void main(String[] args) throws InterruptedException {
       Biodata bio =new Biodata();
      Thread.sleep(5000);
       
       bio.inserBiodata("shadhin  saasd  dsa", "m uhi in   l");
    }
    
}
