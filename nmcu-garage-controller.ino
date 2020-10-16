///////////////////////////////////////////////
//           Прошивка для NodeMCU            //
//    Для системы nmcu-garage-controller     //
//              гаражный контроллер          //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
#include <ESP8266WiFi.h>
const char* ssid     = "SSID";
const char* password = "PASSWORD";

//const char* ssid     = "KOT-Garage_2.4GHz";
//const char* password = "12341234";

const char* host = "your-domain.ru"; //сервер, с которым происходит обмен

#include <OneWire.h>
#include <DallasTemperature.h>
#define GREEN_LED 12
#define YELLOW_LED 14
#define ONE_WIRE_BUS 13
OneWire oneWire(ONE_WIRE_BUS); 
DallasTemperature sensors(&oneWire);

//Задаем буфера каналов реле в ноль
int buff1=0;
int buff2=0;
int buff3=0;
int buff4=0;

//Сопостовляем пины адруинки с релюшками
const int out1=5;
const int out2=4;
const int out3=0;
const int out4=2;

//Вводим темповую переменную для расчета ответа сервера
int tmp=0;

//Инициализация
void setup()
{
 pinMode(15,INPUT_PULLUP);
 Serial.begin(115200);
 delay(10);
 
 sensors.begin(); //стартуем для датчика
 sensors.setResolution(12); //Устанавливаем разрешение датчиков температуры

 pinMode(15,INPUT_PULLUP);

//Задаем пины контроллера на выход для управления реле
 pinMode(out1, OUTPUT);
 pinMode(out2, OUTPUT);
 pinMode(out3, OUTPUT);
 pinMode(out4, OUTPUT);
 
 pinMode(YELLOW_LED, OUTPUT); //Желтый диод - выход
 pinMode(GREEN_LED, OUTPUT); //Зеленый диод - выход

 //Выключаем все реле (вкл - низкий уровень, выкл - высокий уровень)
 digitalWrite(out1, HIGH); //выключаем по умолчанию
 digitalWrite(out2, HIGH);
 digitalWrite(out3, HIGH);
 digitalWrite(out4, HIGH);

 //Выводим отладку в порт
 Serial.println();
 Serial.println();
 Serial.print("Подключение к ");
 Serial.println(ssid);
 WiFi.begin(ssid, password); //works!

 //Ждем пока подключимся к WiFi сети
 while (WiFi.status() != WL_CONNECTED) {
    digitalWrite(YELLOW_LED, HIGH);
    delay(250);
    digitalWrite(YELLOW_LED, LOW);
    delay(250);
    Serial.print(".");
 }
 
 //Подключились, уведомляем
 digitalWrite(YELLOW_LED, LOW);
 Serial.println("");
 Serial.println("WiFi connected");  
 Serial.println("IP address: ");
 Serial.println(WiFi.localIP());
 digitalWrite(GREEN_LED, HIGH);
}



//Основной цикл программы
void loop()
{
  delay(100);
  sensors.requestTemperatures(); //получаем температуру с 1 датчика
  
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  if (!client.connect(host, 80)) { //Если нет подключения к хосту, моргаем код ошибдки и вырубаем все реле
    //Выключаем все реле (вкл - низкий уровень, выкл - высокий уровень)
    digitalWrite(out1, HIGH);
    digitalWrite(out2, HIGH);
    digitalWrite(out3, HIGH);
    digitalWrite(out4, HIGH);
    Serial.println("ошибка подключения");
    digitalWrite(GREEN_LED, LOW);
    digitalWrite(YELLOW_LED, HIGH);
    delay(150);
    digitalWrite(YELLOW_LED, LOW);
    delay(150);
    digitalWrite(YELLOW_LED, HIGH);
    delay(150);
    digitalWrite(YELLOW_LED, LOW);
    delay(150);
    digitalWrite(YELLOW_LED, HIGH);
    delay(150);
    digitalWrite(YELLOW_LED, LOW);
    return;

//Если нет подключения выключаем все каналы реле (ну а мало ли:))
  digitalWrite(out1, HIGH);
  digitalWrite(out2, HIGH);
  digitalWrite(out3, HIGH);
  digitalWrite(out4, HIGH); 
  }
  digitalWrite(GREEN_LED, LOW);
  
//Далее работа с данными и их отправка на сервер
 
 //Формируем GET запрос на сервер
 //Здесь происходит формирование запроса для 10 (или меньше 10) подключенных датчиков температуры DS18B20, которые висят на линии
  delay(100);
  float ds1 = sensors.getTempCByIndex(0);
  float ds2 = sensors.getTempCByIndex(1);
  float ds3 = sensors.getTempCByIndex(2);
  float ds4 = sensors.getTempCByIndex(3);
  float ds5 = sensors.getTempCByIndex(4);
  float ds6 = sensors.getTempCByIndex(5);
  float ds7 = sensors.getTempCByIndex(6);
  float ds8 = sensors.getTempCByIndex(7);
  float ds9 = sensors.getTempCByIndex(8);
  float ds10 = sensors.getTempCByIndex(9);
  String url = "/patch/to/script/folder/add_data.php";
  url += "?dallas1temp=";
  url += ds1;
  url += "&dallas2temp=";
  url += ds2;
  url += "&dallas3temp=";
  url += ds3;
  url += "&dallas4temp=";
  url += ds4;
  url += "&dallas5temp=";
  url += ds5;
  url += "&dallas6temp=";
  url += ds6;
  url += "&dallas7temp=";
  url += ds7;
  url += "&dallas8temp=";
  url += ds8;
  url += "&dallas9temp=";
  url += ds9;
  url += "&dallas10temp=";
  url += ds10;

////////////DEBUG
  Serial.println("* * * * * * * * * D E B U G * * * * * * * * *");
  Serial.print("Sensor 1:  ");
  Serial.println(ds1);

  Serial.print("Sensor 2:  ");
  Serial.println(ds2);

  Serial.print("Sensor 3:  ");
  Serial.println(ds3);

  Serial.print("Sensor 4:  ");
  Serial.println(ds4);

  Serial.print("Sensor 5:  ");
  Serial.println(ds5);

  Serial.print("Sensor 6:  ");
  Serial.println(ds6);

  Serial.print("Sensor 7:  ");
  Serial.println(ds7);


 Serial.print("Sensor 8:  ");
  Serial.println(ds8);

  Serial.print("Sensor 9:  ");
  Serial.println(ds9);

  Serial.print("Sensor 10:  ");
  Serial.println(ds10);
  Serial.println("* * * * ** * E N D  D E B U G* * * * * * *");
////////////END DEBUG

  Serial.print("Запрашиваем URL: ");
  Serial.println(url);
  digitalWrite(GREEN_LED, HIGH); //Начинаем отправку, зажигаем зеленый светодиод
  
  // Шлем составленный запрос на сервер
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(50);
  digitalWrite(GREEN_LED, LOW); //Запрос выполнен, гасим зеленый светодиод
  
  while (client.available()) {
   char c = static_cast<char>(client.read());
   if ( c=='\n') { tmp = tmp + 1; }
   if(tmp==10) {if(c=='1') { buff1=1; } else { buff1=0; }}           
   if(tmp==11) {if(c=='1') { buff2=1; } else { buff2=0; }}  
   if(tmp==12) {if(c=='1') { buff3=1; } else { buff3=0; }}
   if(tmp==13) {if(c=='1') { buff4=1; } else { buff4=0; }}   
  }
client.stop();
client.flush();
tmp = 0;

//Обработка реле. Включаем или выключаем
  if ( buff1==1) { digitalWrite (out1, LOW); }else {digitalWrite(out1, HIGH);}
  if ( buff2==1) { digitalWrite (out2, LOW); }else {digitalWrite(out2, HIGH);}
  if ( buff3==1) { digitalWrite (out3, LOW); }else {digitalWrite(out3, HIGH);}
  if ( buff4==1) { digitalWrite (out4, LOW); }else {digitalWrite(out4, HIGH);}
}
