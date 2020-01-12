/......
Tugas KP Prototype Sistem Pendeteksi Banjir Berbasis IoT
S1 Teknik Informatika
Universitas Widyatama

Nama  : Sultan
NPM   : 061304016

Dosen Pembimbing Kampus : Ari Purno Wahyu S.Kom., M.Kom.
Pembimbing Lapangan     : Nurfitriadi S.E.
....../

int TURBINE;      //pengukuran SINYAL data yang bersifat incremental
int HSensor = 2; //nama alias pada pin 2
int Calc;
int trig = 8;
int echo = 9;

void speedrpm ()    //fungsi penghitungan dan interrupt
{
TURBINE++; //bersifat incrementing (dengan mode falling edge)
}
 
void setup() {
  pinMode(HSensor, INPUT); //inisialisasi sebagai input
  Serial.begin(115200); 
  attachInterrupt(00, speedrpm, RISING); //cara penulisan perintah interrupt
  pinMode(trig, OUTPUT);
  pinMode(echo, INPUT); 
}
 
void loop () {
 long t = 0, h = 0, hp = 0;
  
  // Transmitting pulse
  digitalWrite(trig, LOW);
  delayMicroseconds(2);
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);
  
  // Waiting for pulse
  t = pulseIn(echo, HIGH);
  
  // Calculating distance 
  h = t / 58.8;
  h = 50 - h; 
  hp = h;

  hp = 2 * hp;

  TURBINE = 00; //data awal = 0
  sei(); //perintah aktifnya mode interrupt
  delay(1000);
  cli(); //perintah untuk matinya program interrupt
  Calc = (TURBINE * 60 / 7.5); //Pulsa * 60 / 7.5 

  Serial.println(String(hp) + " " + String(Calc));
  delay (2000); //nilai delay 1 detik
}
