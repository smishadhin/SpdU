
package onuchokri;


public class LocalEvent {
    
    private String name;
    private String blood;   
    private String contact;
    private String add;

    
    public LocalEvent(){
        this.name= null;
        this.blood= null;
        this.contact= null;
        this.add=null;
        
    }
    
  
    public LocalEvent(String name,String blood,String contact,String age){
         this.name= name;
        this.blood= blood;
        this.contact= contact;
        this.add=age;
        
    }
    
    
    
    
    
    public String getName() {
        return name;
    }

    /**
     * @param name the name to set
     */
    public void setName(String name) {
        this.name = name;
    }

    /**
     * @return the blood
     */
    public String getBlood() {
        return blood;
    }

    /**
     * @param blood the blood to set
     */
    public void setBlood(String blood) {
        this.blood = blood;
    }

    /**
     * @return the contact
     */
    public String getContact() {
        return contact;
    }

    /**
     * @param contact the contact to set
     */
    public void setContact(String contact) {
        this.contact = contact;
    }

    /**
     * @return the age
     */
    public String getAge() {
        return add;
    }

    /**
     * @param age the age to set
     */
    public void setAge(String age) {
        this.add = age;
    }
              
    
}
 
