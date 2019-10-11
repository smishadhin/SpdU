
package onuchokri;


public class teacherevent {
    
    private String teacherinitial;
    private String idteacher;   

    public teacherevent() {
        this.teacherinitial = null;
        this.idteacher = null;
    }
    
    public teacherevent(String teacherinitial, String idteacher) {
        this.teacherinitial = teacherinitial;
        this.idteacher = idteacher;
    }

   

    public String getTeacherinitial() {
        return teacherinitial;
    }

    public void setTeacherinitial(String teacherinitial) {
        this.teacherinitial = teacherinitial;
    }

    public String getIdteacher() {
        return idteacher;
    }

    public void setIdteacher(String idteacher) {
        this.idteacher = idteacher;
    }
   

    
  
}
 
