/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;

/**
 *
 * @author Alessio Pardini
 */
public class ServletElaborato extends HttpServlet {

    
    private Connection con = null;
    private String dbms_url = "jdbc:mysql://localhost:3306/asl";

    public void init() {
        try {
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(dbms_url, "root", "");
            System.out.println("Connessione con dbms effettuata");
            // creare la connessione con il database
        } catch (SQLException ex) {
            con = null;
            System.out.println("Errore connessione DBMS");
        } catch (ClassNotFoundException ex) {
            System.out.println("Errore connessione DBMS");
        }
    }
    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //controllo se la connessione al db è andata a buon fine
        if(con == null){
            response.sendError(500,"Errore di connessio al db.");
            return;
        }
        //ottengo la url, per gestire le varie richieste
        String url = request.getRequestURL().toString();
        //richiesta esame
        if (url.endsWith("esame")) {
            String id_esame = request.getParameter("id_esame");
            String data_prenotazione = request.getParameter("data_prenotazione");
            //Controlla se i parametro siano presenti
            if (id_esame == null || id_esame.isEmpty() || data_prenotazione == null || data_prenotazione.isEmpty()) {
                //Restituisce un errore nel caso in cui non lo siano.
                response.sendError(402, "Parametri mancanti");
                return; //serve il return altrimenti il metodo viene eseguito comunque
            }
            try {
                //query che permette di ottenere i dati di uno specifico esame
                String command = "SELECT esame.* FROM esame WHERE id_esame= ? AND data_prenotazione= ?;";
                PreparedStatement stat = con.prepareStatement(command);
                stat.setString(1, id_esame);
                stat.setString(2, data_prenotazione);
                System.out.println(stat);
                //eseguo il comando
                ResultSet rs = stat.executeQuery();
                rs.next();
                //costruzione XML
                response.setContentType("text/xml;charset=UTF-8");
                PrintWriter w = response.getWriter();
                w.println("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
                w.println("<esame>");
                
                    w.print("<id_esame>");
                    w.print(rs.getString("id_esame"));  
                    w.println("</id_esame>");
                    
                    w.print("<data_prenotazione>");
                    w.print(rs.getDate("data_prenotazione"));
                    w.println("</data_prenotazione>");
                    
                    w.print("<id_prestazione>");
                    w.print(rs.getString("id_prestazione"));
                    w.println("</id_prestazione>");
                    
                    w.print("<temperatura_corporea_gradi>");
                    w.print(rs.getDouble("temperatura_corporea_gradi"));
                    w.println("</temperatura_corporea_gradi>");
                    
                    w.print("<pressione_sanguigna_mmHG>");
                    w.print(rs.getDouble("pressione_sanguigna_mmHG"));
                    w.println("</pressione_sanguigna_mmHG>");
                    
                    w.print("<frequenza_respiratoria_attiMinuto>");
                    w.print(rs.getDouble("frequenza_respiratoria_attiMinuto"));
                    w.println("</frequenza_respiratoria_attiMinuto>");
                    
                    w.print("<ossigenazione_sanguigna_percentuale>");
                    w.print(rs.getInt("ossigenazione_sanguigna_percentuale"));
                    w.println("</ossigenazione_sanguigna_percentuale>");
                    
                    w.print("<frequenza_cardiaca_bpm>");
                    w.print(rs.getDouble("frequenza_cardiaca_bpm"));
                    w.println("</frequenza_cardiaca_bpm>");
                    
                w.println("</esame>");
                w.close();
                //set status
                response.setStatus(200);

            } catch (SQLException ex) {
                //viene sollevata una eccezione se il record non è stato inserito in precedenza
                response.sendError(401, "Record non presente");
                return;
            }        
        //richiesta listaReport    
        } else if (url.endsWith("listaReport")) {
            String matricola = request.getParameter("matricola");
            //Controlla se il parametro è presente
            if (matricola == null || matricola.isEmpty()) {
                //Restituisce un errore nel caso in cui non lo sia
                response.sendError(402, "Parametri mancanti");
                return; //serve il return altrimenti il metodo viene eseguito comunque
            }
            try {
                ////query che permette di ottenere i dati di tutti i report redatti da uno specifico operatore
                String command = "SELECT report.* FROM report WHERE matricola = ?";
                PreparedStatement stat = con.prepareStatement(command);
                stat.setString(1, matricola);

                //viene eseguito il comando
                ResultSet rs = stat.executeQuery();
                
                //costruzione XML
                response.setContentType("text/xml;charset=UTF-8");
                PrintWriter w = response.getWriter();
                w.println("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
                w.println("<lista_report>");
                while(rs.next()){
                    w.println("<report>");
                    
                    w.print("<id_esame>");
                    w.print(rs.getString("id_esame")); 
                    w.println("</id_esame>");
                    
                    w.print("<data_prenotazione>");
                    w.print(rs.getString("data_prenotazione")); 
                    w.println("</data_prenotazione>");
                    
                    w.print("<id_cartella_clinica>");
                    w.print(rs.getString("id_cartella_clinica")); 
                    w.println("</id_cartella_clinica>");
                    
                    w.print("<codice_tessera>");
                    w.print(rs.getString("codice_tessera")); 
                    w.println("</codice_tessera>");
                    
                    w.print("<matricola>");
                    w.print(rs.getString("matricola")); 
                    w.println("</matricola>");
                    
                    w.print("<dataOra_inizio>");
                    w.print(rs.getString("dataOra_inizio"));
                    w.println("</dataOra_inizio>");
                    
                    w.print("<dataOra_fine>");
                    w.print(rs.getString("dataOra_fine"));
                    w.println("</dataOra_fine>");
                    
                    w.print("<descrizione>");
                    w.print(rs.getString("descrizione"));
                    w.println("</descrizione>");
                    
                    w.println("</report>");
                }
                w.println("</lista_report>");
                w.close();
                //set status
                response.setStatus(200);

            } catch (SQLException ex) {
                //viene sollevata una eccezione se il record non è stato inserito in precedenza
                response.sendError(401, "Record non presente");
                return;
            }        
        }
        else{
            //nel caso in cui la richiesta non corrisponde alle richieste gestibili
           response.sendError(400, "richiesta errata");
       }  
    }
    

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //controllo connesione db
       if(con == null){
            response.sendError(500,"Errore di connessio al db.");
            return;
        }
       //prendo la url, per gestire richiesta specifica
       String url = request.getRequestURL().toString();
       //gestione richiesta nuovoEsame
       if (url.endsWith("nuovoEsame")) {
            BufferedReader input = request.getReader();
            // estrazione dell'xml dal  body della richiesta
            StringBuilder xml = new StringBuilder();
            String line;
            // BufferedWriter file = new BufferedWriter(new FileWriter("request.xml"));
            while ((line = input.readLine()) != null) {
                // file.write(line);
                // file.newLine();
                xml.append(line);
            }
            input.close();
            try {
                // parsing dell'xml ricevuto
                DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
                DocumentBuilder builder = factory.newDocumentBuilder();
                Document document;
                // il parsing non viene fatto a partire dal file ma dalla stringa
                document = builder.parse(new ByteArrayInputStream(xml.toString().getBytes()));
                Element root = document.getDocumentElement();
                // parsing id_esame
                NodeList list = root.getElementsByTagName("id_esame");
                String id_esame = null;
                if(list != null && list.getLength() > 0){
                    id_esame = list.item(0).getFirstChild().getNodeValue();   
                }
                // parsing data_prenotazione
                NodeList list1 = root.getElementsByTagName("data_prenotazione");
                String data_prenotazione = null;
                if(list1 != null && list1.getLength() > 0){
                    data_prenotazione = list1.item(0).getFirstChild().getNodeValue();   
                }
                // parsing id_prestazione
                NodeList list2 = root.getElementsByTagName("id_prestazione");
                String id_prestazione = null;
                if(list2 != null && list2.getLength() > 0){
                    id_prestazione = list2.item(0).getFirstChild().getNodeValue();
                }
                // parsing temperatura_corporea_gradi
                NodeList list3 = root.getElementsByTagName("temperatura_corporea_gradi");
                String temperatura_corporea_gradi = null;
                if(list3 != null && list3.getLength() > 0){
                    temperatura_corporea_gradi = list3.item(0).getFirstChild().getNodeValue();
                }
                // parsing pressione_sanguigna_mmHG
                NodeList list4 = root.getElementsByTagName("pressione_sanguigna_mmHG");
                String pressione_sanguigna_mmHG = null;
                if(list4 != null && list4.getLength() > 0){
                    pressione_sanguigna_mmHG = list4.item(0).getFirstChild().getNodeValue();
                }
                // parsing frequenza_respiratoria_attiMinuto
                NodeList list5 = root.getElementsByTagName("frequenza_respiratoria_attiMinuto");
                String frequenza_respiratoria_attiMinuto = null;
                if(list5 != null && list5.getLength() > 0){
                    frequenza_respiratoria_attiMinuto = list5.item(0).getFirstChild().getNodeValue();
                }
                // parsing ossigenazione_sanguigna_percentuale
                NodeList list6 = root.getElementsByTagName("ossigenazione_sanguigna_percentuale");
                String ossigenazione_sanguigna_percentuale = null;
                if(list6 != null && list6.getLength() > 0){
                    ossigenazione_sanguigna_percentuale = list6.item(0).getFirstChild().getNodeValue();
                }
                // parsing frequenza_cardiaca_bpm
                NodeList list7 = root.getElementsByTagName("frequenza_cardiaca_bpm");
                String frequenza_cardiaca_bpm = null;
                if(list7 != null && list7.getLength() > 0){
                    frequenza_cardiaca_bpm = list7.item(0).getFirstChild().getNodeValue();
                }
                //Conversione di alcuni parametri nei tipi adatti
                double temperatura_corporea_gradi_double=0.0;
                double pressione_sanguigna_mmHG_double=0.0;
                double frequenza_respiratoria_attiMinuto_double=0.0;
                int ossigenazione_sanguigna_percentuale_int=0;
                double frequenza_cardiaca_bpm_double=0.0;
                try {
                // Ovviamente la conversione avviene all'interno di un costrutto try-catch per gestire eventuali eccezioni
                temperatura_corporea_gradi_double = Double.parseDouble(temperatura_corporea_gradi);
                pressione_sanguigna_mmHG_double = Double.parseDouble(pressione_sanguigna_mmHG);
                frequenza_respiratoria_attiMinuto_double = Double.parseDouble(frequenza_respiratoria_attiMinuto);
                ossigenazione_sanguigna_percentuale_int= Integer.parseInt(ossigenazione_sanguigna_percentuale);
                frequenza_cardiaca_bpm_double = Double.parseDouble(frequenza_cardiaca_bpm);
                } catch (NumberFormatException e) {
                    response.sendError(400, "Parametri errati");
                    return;
                }
                //SQL per inserimento nuovo esame
                String command = "INSERT INTO esame values (?,?,?,?,?,?,?,?)";
                PreparedStatement stat = con.prepareStatement(command);
                stat.setString(1, id_esame);
                stat.setString(2, data_prenotazione);
                stat.setString(3, id_prestazione);
                stat.setDouble(4, temperatura_corporea_gradi_double);
                stat.setDouble(5, pressione_sanguigna_mmHG_double);
                stat.setDouble(6, pressione_sanguigna_mmHG_double);
                stat.setInt(7, ossigenazione_sanguigna_percentuale_int);
                stat.setDouble(8, frequenza_cardiaca_bpm_double);
                //eseguo il comando
                stat.executeUpdate();
                //INVIO STATUS 
                PrintWriter res = response.getWriter();
                res.append("Inserimento riuscito");
                response.setStatus(200);
                //gestione delle varie eccezioni
            }catch(SQLException ex){
                response.sendError(401, "Errore durante l'inserimento!");   
            }catch(ParserConfigurationException ex){
                response.sendError(402, "XML parser error!");
            }
            catch(SAXException exception){
                 response.sendError(402, "XML parser error!");
            }
       }
       else{
           //nel caso in cui la richiesta non corrisponde
           response.sendError(400, "richiesta errata");
       }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>
    
    //disattivazione servlet (disconnessione da DBMS)
    public void destroy(){
        try{
            con.close();
        }
        catch(SQLException exception){
        }
    }
    
    
}
