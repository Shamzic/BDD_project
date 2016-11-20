/* Simon HAMERY : simon.hamery2@etu.unistra.fr

  Comment appeler cette fonction : 
  SQL> @procedure2.sql
  SQL> exec news;

*/
set serveroutput on format wrapped;
set linesize 9999;

CREATE OR REPLACE PROCEDURE news
IS
CURSOR curs_video IS (select v.nom_vid as "NOM DES VIDEOS",d.date_diff as "DATE_DIFFUSION" from diffusion d,video v where d.id_vid=v.id_vid and to_char(d.date_diff,'IW') =to_char(sysdate,'IW')) ;

BEGIN
    
   dbms_output.put_line( '                                                                                              
                                                                                              
  N     T  RNEWSLE T     S     R   SLET   N       ERNEWSL TTERNEW LETTERN  SLETTER  WSLETT    
  LE    N  S       E    TTE    S  T    EW L       W          S       E     T        T     W   
  E N   L  T        T   N W   T   N     T E       T          T       E     E        N     T   
  W L   E  E        N   L T   N   LE      W       N          E       R     E        L     N   
  T  R  W  ETTERNE  L   E N   L    RNE    T       LETTERN    E       S     RNEWSLE  E     L   
  N  S  T  R         R E   E T        TT  N       E          R       T     S        WSLETT    
  L   E N  S         S E   R E          W L       W          S       E     T        T   N     
  E   W L  T         TER   SLE    N     T E       T          T       E     E        N    E    
  W    TE  E          W     E     L     N W       N          E       R     E        L    R    
  T     W  ETTERNE    T     W      RNEWS  TTERNE  LETTERN    E       S     RNEWSLE  E     L   
                                      
                                                                                              
                    ------- Voici les diffusions des vidéo de la semaine  ---------
                                                                                          ' ) ;
   FOR c in curs_video
   LOOP
   dbms_output.put_line('Video : '||c."NOM DES VIDEOS"||' diffusée à la date suivante : '||c."DATE_DIFFUSION"); 
   END LOOP;
END;
/
show errors procedure news;
