/* Simon HAMERY : simon.hamery2@etu.unistra.fr
  
  Cette procédure génère ​N épisodes, un par semaine, entre une date de début et une
  date de fin indiquées en paramètre de la procédure. L’incrémentation du numéro d’épisode
  part du dernier épisode dans la base. L'émission associé est la N°10.
  
  Comment appeler cette fonction (exemple avec 3 semaines, 3 épisodes générés) : 
  SQL> @procedure3.sql
  SQL> exec generation(to_date('2016/11/01','yyyy/mm/dd'),to_date('2016/11/17','yyyy/mm/dd'))
  3 vidéo(s) ont été ajoutées à la base...

  On peut vérifier :
  SQL> select id_vid, anneeDif_vid from video where id_ems=10;

    ID_VID ANNEEDIF_VID
---------- ---------------
	16 16-NOV-01
	17 16-NOV-08
	18 16-NOV-15

  
  
*/
set serveroutput on format wrapped;

CREATE OR REPLACE PROCEDURE generation(date_debut date,date_fin date)
IS
max_id number(2);
num_ep number(2);
num_sem_debut number(2);
num_sem_fin number(2);
compteur number(2) :=0;
v_date date;
BEGIN
   select max(id_vid) into max_id from video;
   select max(v.numero_episode) into num_ep from emission e,video v where e.id_ems=10;
   select to_char(date_debut,'IW') into num_sem_debut from dual;
   select to_char(date_fin,'IW') into num_sem_fin from dual;
   dbms_output.put_line(num_sem_fin-num_sem_debut+1||' vidéo(s) ont été ajoutées à la base...');
   v_date:=date_debut;
   FOR i IN 0 .. num_sem_fin-num_sem_debut
   LOOP
    max_id := max_id +1;
    num_ep := num_ep +1;    
    insert into video values(max_id,'titre temporaire','à venir',1,TO_DATE(v_date,'yyyy/mm/dd'),'N','LARGE',10,10,'NO COUNTRY',10,num_ep);
    v_date := v_date + interval '7' day;
    compteur := compteur +7;
   END LOOP;
END;
/
show errors procedure generation;
