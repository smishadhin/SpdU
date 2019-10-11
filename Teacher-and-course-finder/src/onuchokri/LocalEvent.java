
package onuchokri;


public class LocalEvent {
    
    private String techini;
    private String techid;   
    private String cocode;
    private String cotitle;

    public LocalEvent(String techini, String techid, String cocode, String cotitle) {
        this.techini = techini;
        this.techid = techid;
        this.cocode = cocode;
        this.cotitle = cotitle;
    }
    public LocalEvent() {
        this.techini = null;
        this.techid = null;
        this.cocode = null;
        this.cotitle = null;
    }

    public String getTechini() {
        return techini;
    }

    public void setTechini(String techini) {
        this.techini = techini;
    }

    public String getTechid() {
        return techid;
    }

    public void setTechid(String techid) {
        this.techid = techid;
    }

    public String getCocode() {
        return cocode;
    }

    public void setCocode(String cocode) {
        this.cocode = cocode;
    }

    public String getCotitle() {
        return cotitle;
    }

    public void setCotitle(String cotitle) {
        this.cotitle = cotitle;
    }

    
   
              
    
}
 
