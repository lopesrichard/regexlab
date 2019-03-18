import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Main {
  public static void main(String[] args) {
    
    /* 4. Replacing only the first occurrence */
        
    String regex  = "\\d([a-z])";
    String replacement = "@";
    String string = "1a2b3c";

    Pattern p = Pattern.compile(regex);
    Matcher m = p.matcher(string);
    
    String newString = m.replaceFirst(replacement);
    System.out.println(newString); // @2b3c

    /* 5. Replacing all occurrences */
        
    String regex  = "\\d([a-z])";
    String replacement = "@";
    String string = "1a2b3c";

    Pattern p = Pattern.compile(regex);
    Matcher m = p.matcher(string);
    
    String newString = m.replaceAll(replacement);
    System.out.println(newString); // @@@

    /* 6. Splitting a string into an array */

    String regex  = "\\d";
    String string = "1a2b3c";

    Pattern p = Pattern.compile(regex);
    
    String[] arrayString = p.split(string);
    
    for (String s : arrayString) {
        System.out.print(s + " "); // a b c
    }
  }
}
