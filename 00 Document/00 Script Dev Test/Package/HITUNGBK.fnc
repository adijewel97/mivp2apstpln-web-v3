CREATE OR REPLACE FUNCTION hitungbk (
   psysdate      VARCHAR2,
   pblth         VARCHAR2,
   ptgljttempo   VARCHAR2,
   prpbk1        NUMBER,
   prpbk2        NUMBER,
   prpbk3        NUMBER
)
   RETURN NUMBER
IS
   vrpbk   NUMBER;
BEGIN
   IF pblth = SUBSTR (psysdate, 1, 6)
   THEN
      -- jika blth di bulan berjalan
      -- tgljttempo ddmmyyyy
      IF psysdate <=
               SUBSTR (ptgljttempo, 5, 4)
            || SUBSTR (ptgljttempo, 3, 2)
            || SUBSTR (ptgljttempo, 1, 2)
      THEN
         -- jika hari ini di bawah/sama dengan tgljttempo
         vrpbk := 0;
         RETURN vrpbk;
      ELSE
         vrpbk := prpbk1;
         RETURN vrpbk;
      END IF;
   ELSE
      IF psysdate <=
               SUBSTR (ptgljttempo, 5, 4)
            || SUBSTR (ptgljttempo, 3, 2)
            || SUBSTR (ptgljttempo, 1, 2)
      THEN
         -- jika hari ini di bawah/sama dengan tgljttempo
         vrpbk := 0;
         RETURN vrpbk;
      ELSE
         IF pblth =
               TO_CHAR (ADD_MONTHS (TO_DATE (SUBSTR (psysdate, 1, 6),
                                             'YYYYMM'),
                                    -1
                                   ),
                        'yyyymm'
                       )
         THEN
            RETURN prpbk2;
         ELSE
            RETURN prpbk3;
         END IF;
      END IF;
   END IF;
EXCEPTION
   WHEN OTHERS
   THEN
      RETURN 0;
END;
/