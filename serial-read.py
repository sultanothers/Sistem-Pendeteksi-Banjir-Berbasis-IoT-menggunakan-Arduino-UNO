"""
Tugas KP Prototype Sistem Pendeteksi Banjir Berbasis IoT
S1 Teknik Informatika
Universitas Widyatama

Nama  : Sultan
NPM   : 061304016

Dosen Pembimbing Kampus : Ari Purno Wahyu S.Kom., M.Kom.
Pembimbing Lapangan     : Nurfitriadi S.E.
"""


import serial, time, requests

# port = str(input())
port = "/dev/tty.usbmodem146101"

ser = serial.Serial(
    port= port,
    baudrate = '115200',
    parity=serial.PARITY_NONE,\
    stopbits=serial.STOPBITS_ONE,\
    bytesize=serial.EIGHTBITS,\
    timeout=0
)

print("connected to: " + ser.portstr)
count = 1

while True:
    line = ser.readline()
    val = line.split()
    if len(val) > 0:
        val1 = str(val[0].decode())
        val2 = str(val[1].decode())
        print("{}  {}".format(val1,val2))
        # params = {'value1': val[0], 'value2': val[1]}
        r = requests.get("http://www.sultanothers.xyz/wemosdata/post-esp-data.php?value1={}&value2={}".format(val1, val2))
        print(r.url)
    time.sleep(1)
ser.close()
