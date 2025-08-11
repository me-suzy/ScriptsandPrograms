<?

include("jodchat_conf.php");


global $moderator_password;
global $moderator_kick;
global $moderator_bomb;
global $check_rate;



#--------------------------------- virtual files
$virtual_files = 'YWNoYXQuaHRtJTI1MEFzJTI1MjUzQ2h0bWwlMjUyNTNFJ
TI1MjUwRCUyNTI1MEElMjUyNTBEJTI1MjUwQSUyNTI1M0
Nib2R5JTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MjUwRCU
yNTI1MEElMjUyNTNDc2NyaXB0JTI1MkJsYW5ndWFnZSUy
NTI1M0QlMjUyNTIyamF2YXNjcmlwdCUyNTI1MjIlMjUyQ
mRlZmVyJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MjUwRC
UyNTI1MEElMjUyNTBEJTI1MjUwQWZ1bmN0aW9uJTI1MkJ
sb2FkU2NyaXB0JTI1MjUyOHVybCUyNTI1MjklMjUyQiUy
NTI1N0IlMjUyNTBEJTI1MjUwQSUyNTJCJTI1MkJpZiUyN
TJCJTI1MjUyOGRvY3VtZW50LmxheWVycyUyNTI1MjklMj
UyQiUyNTI1N0IlMjUyNTBEJTI1MjUwQSUyNTJCJTI1MkI
lMjUyQiUyNTJCd2luZG93LmxvY2F0aW9uLmhyZWYlMjUy
QiUyNTI1M0QlMjUyQnVybCUyNTI1M0IlMjUyNTBEJTI1M
jUwQSUyNTJCJTI1MkIlMjUyNTdEJTI1MkJlbHNlJTI1Mk
JpZiUyNTJCJTI1MjUyOGRvY3VtZW50LmdldEVsZW1lbnR
CeUlkJTI1MjUyOSUyNTJCJTI1MjU3QiUyNTI1MEQlMjUy
NTBBJTI1MkIlMjUyQiUyNTI1MEQlMjUyNTBBJTI1MkIlM
jUyQiUyNTJCJTI1MkJ2YXIlMjUyQnNjcmlwdCUyNTJCJT
I1MjUzRCUyNTJCZG9jdW1lbnQuY3JlYXRlRWxlbWVudCU
yNTI1MjglMjUyNTI3c2NyaXB0JTI1MjUyNyUyNTI1Mjkl
MjUyNTNCJTI1MjUwRCUyNTI1MEElMjUyQiUyNTJCJTI1M
kIlMjUyQnNjcmlwdC5kZWZlciUyNTJCJTI1MjUzRCUyNT
JCdHJ1ZSUyNTI1M0IlMjUyNTBEJTI1MjUwQSUyNTJCJTI
1MkIlMjUyQiUyNTJCc2NyaXB0LnNyYyUyNTJCJTI1MjUz
RCUyNTJCdXJsJTI1MjUzQiUyNTI1MEQlMjUyNTBBJTI1M
kIlMjUyQiUyNTJCJTI1MkJkb2N1bWVudC5nZXRFbGVtZW
50c0J5VGFnTmFtZSUyNTI1MjglMjUyNTI3aGVhZCUyNTI
1MjclMjUyNTI5JTI1MjU1QjAlMjUyNTVELmFwcGVuZENo
aWxkJTI1MjUyOHNjcmlwdCUyNTI1MjklMjUyNTNCJTI1M
jUwRCUyNTI1MEElMjUyQiUyNTJCJTI1MjU3RCUyNTI1ME
QlMjUyNTBBJTI1MjU3RCUyNTI1MEQlMjUyNTBBJTI1MjU
wRCUyNTI1MEElMjUyNTBEJTI1MjUwQWZ1bmN0aW9uJTI1
MkJhcHBlbmRfY2hhdF90ZXJtaW5hbCUyNTI1Mjhjb2RlJ
TI1MjUyOSUyNTI1N0IlMjUyNTBEJTI1MjUwQSUyNTI1Mk
YlMjUyNTJGZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQlMjU
yNTI4JTI1MjUyMmNoYXRfdGVybWluYWxfZnJhbWUlMjUy
NTIyJTI1MjUyOS5pbm5lckhUTUwlMjUyQiUyNTI1M0QlM
jUyQmRvY3VtZW50LmdldEVsZW1lbnRCeUlkJTI1MjUyOC
UyNTI1MjJjaGF0X3Rlcm1pbmFsX2ZyYW1lJTI1MjUyMiU
yNTI1MjkuaW5uZXJIVE1MJTI1MkIlMjUyNTJCJTI1MkJj
b2RlJTI1MjUzQiUyNTI1MEQlMjUyNTBBZnJhbWVzLmNoY
XRfdGVybWluYWxfZnJhbWUuZG9jdW1lbnQuYm9keS5pbm
5lckhUTUwlMjUyQiUyNTI1M0QlMjUyQmZyYW1lcy5jaGF
0X3Rlcm1pbmFsX2ZyYW1lLmRvY3VtZW50LmJvZHkuaW5u
ZXJIVE1MJTI1MkIlMjUyNTJCJTI1MkJjb2RlJTI1MjUzQ
iUyNTI1MEQlMjUyNTBBJTI1MjU3RCUyNTI1MEQlMjUyNT
BBJTI1MjUwRCUyNTI1MEFmdW5jdGlvbiUyNTJCcmVmcmV
zaF9jaGF0X3Rlcm1pbmFsJTI1MjUyOG9sZF9tZXNzYWdl
X2lkJTI1MjUyOSUyNTI1N0IlMjUyNTBEJTI1MjUwQSUyN
TI1MDlsb2FkU2NyaXB0JTI1MjUyOCUyNTI1MjIlMjUyNT
I0c2VydmVyJTI1MjUyOFBIUF9TRUxGJTI1MjUyOSUyNTI
1MjQlMjUyNTNGbW9kZSUyNTI1M0RjaGF0X2pzX3Rlcm1p
bmFsJTI1MjUyNm9sZF9tZXNzYWdlX2lkJTI1MjUzRCUyN
TI1MjIlMjUyQiUyNTI1MkIlMjUyQm9sZF9tZXNzYWdlX2
lkJTI1MjUyOSUyNTI1M0IlMjUyNTBEJTI1MjUwQSUyNTI
1N0QlMjUyNTBEJTI1MjUwQSUyNTI1MEQlMjUyNTBBZnVu
Y3Rpb24lMjUyQmNoYXRfc2VuZF9tZXNzYWdlJTI1MjUyO
CUyNTI1MjklMjUyNTdCJTI1MjUwRCUyNTI1MEElMjUyNT
A5dmFyJTI1MkJtZXNzYWdlJTI1MkIlMjUyNTNEJTI1MkJ
lc2NhcGUlMjUyNTI4ZG9jdW1lbnQuY2hhdF9mb3JtLmNo
YXRfbWVzc2FnZS52YWx1ZSUyNTI1MjklMjUyNTNCJTI1M
jUwRCUyNTI1MEElMjUyNTA5bG9hZFNjcmlwdCUyNTI1Mj
glMjUyNTIyJTI1MjUyNHNlcnZlciUyNTI1MjhQSFBfU0V
MRiUyNTI1MjklMjUyNTI0JTI1MjUzRm1vZGUlMjUyNTNE
Y2hhdF9qc19zZW5kX21lc3NhZ2UlMjUyNTI2bWVzc2FnZ
SUyNTI1M0QlMjUyNTIyJTI1MkIlMjUyNTJCJTI1MkJtZX
NzYWdlJTI1MjUyOSUyNTI1M0IlMjUyNTBEJTI1MjUwQSU
yNTI1MDlkb2N1bWVudC5jaGF0X2Zvcm0uY2hhdF9tZXNz
YWdlLnZhbHVlJTI1MkIlMjUyNTNEJTI1MkIlMjUyNTIyJ
TI1MjUyMiUyNTI1M0IlMjUyNTBEJTI1MjUwQSUyNTI1N0
QlMjUyNTBEJTI1MjUwQSUyNTI1MEQlMjUyNTBBJTI1MjU
wRCUyNTI1MEFmdW5jdGlvbiUyNTJCcGFnZVNjcm9sbCUy
NTI1MjglMjUyNTI5JTI1MkIlMjUyNTdCJTI1MjUwRCUyN
TI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1MDlmcm
FtZXMuY2hhdF90ZXJtaW5hbF9mcmFtZS5zY3JvbGxCeSU
yNTI1MjgwJTI1MjUyQzUwJTI1MjUyOSUyNTI1M0IlMjUy
NTBEJTI1MjUwQSUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1M
jUwOXNldFRpbWVvdXQlMjUyNTI4JTI1MjUyMnBhZ2VTY3
JvbGwlMjUyNTI4JTI1MjUyOSUyNTI1MjIlMjUyNTJDMTA
wJTI1MjUyOSUyNTI1M0IlMjUyNTBEJTI1MjUwQSUyNTI1
N0QlMjUyNTBEJTI1MjUwQXNldFRpbWVvdXQlMjUyNTI4J
TI1MjUyMnBhZ2VTY3JvbGwlMjUyNTI4JTI1MjUyOSUyNT
I1MjIlMjUyNTJDNTAwMCUyNTI1MjklMjUyNTNCJTI1MjU
wRCUyNTI1MEElMjUyNTBEJTI1MjUwQWZ1bmN0aW9uJTI1
MkJyZWZyZXNoX3dpbmRvdyUyNTI1MjglMjUyNTI5JTI1M
jU3QiUyNTI1MEQlMjUyNTBBJTI1MjUwOWlmJTI1MkIlMj
UyNTI4ZG9jdW1lbnQubGF5ZXJzJTI1MjUyOSUyNTJCJTI
1MjU3QiUyNTI1MEQlMjUyNTBBJTI1MjUwOSUyNTI1MDl3
aW5kb3cubG9jYXRpb24ucmVsb2FkJTI1MjUyOCUyNTI1M
jklMjUyNTNCJTI1MjUwRCUyNTI1MEElMjUyNTA5JTI1Mj
U3RCUyNTJCZWxzZSUyNTJCJTI1MjU3QiUyNTI1MEQlMjU
yNTBBJTI1MjUwOSUyNTI1MDloaXN0b3J5LmdvJTI1MjUy
OCUyNTI1MjklMjUyNTNCJTI1MjUwRCUyNTI1MEElMjUyN
TA5JTI1MjU3RCUyNTI1MEQlMjUyNTBBJTI1MjU3RCUyNT
I1MEQlMjUyNTBBJTI1MjUwRCUyNTI1MEFmdW5jdGlvbiU
yNTJCY2hhdF9sb2dnZWRfb3V0JTI1MjUyOCUyNTI1Mjkl
MjUyNTdCJTI1MjUwRCUyNTI1MEFhbGVydCUyNTI1MjglM
jUyNTIyc29ycnklMjUyQmNvdWxkbiUyNTI1Mjd0JTI1Mk
JzZW5kJTI1MkJtZXNzYWdlJTI1MkJhcyUyNTJCeW91ciU
yNTJCbm8lMjUyQmxvbmdlciUyNTJCbG9nZ2VkJTI1MkJp
biUyNTI1MjIlMjUyNTI5JTI1MjUzQiUyNTI1MEQlMjUyN
TBBcmVmcmVzaF93aW5kb3clMjUyNTI4JTI1MjUyOSUyNT
I1M0IlMjUyNTBEJTI1MjUwQSUyNTI1N0QlMjUyNTBEJTI
1MjUwQSUyNTI1MEQlMjUyNTBBZnVuY3Rpb24lMjUyQmNo
YXRfa2lja191c2VyJTI1MjUyOCUyNTI1MjklMjUyNTdCJ
TI1MjUwRCUyNTI1MEFhbGVydCUyNTI1MjglMjUyNTIyWW
91JTI1MjUyN3ZlJTI1MkJiZWVuJTI1MkJraWNrZWQlMjU
yQm91dCUyNTJCb2YlMjUyQnRoaXMlMjUyQmNoYXQlMjUy
QnJvb20lMjUyNTIxJTI1MjUyMiUyNTI1MjklMjUyNTNCJ
TI1MjUwRCUyNTI1MEFyZWZyZXNoX3dpbmRvdyUyNTI1Mj
glMjUyNTI5JTI1MjUzQiUyNTI1MEQlMjUyNTBBJTI1MjU
3RCUyNTI1MEQlMjUyNTBBJTI1MjUwRCUyNTI1MEFmdW5j
dGlvbiUyNTJCY2hhdF9ib21iX3VzZXIlMjUyNTI4JTI1M
jUyOSUyNTI1N0IlMjUyNTBEJTI1MjUwQXZhciUyNTJCbW
VtX292ZXJsb2FkJTI1MkIlMjUyNTNEJTI1MkIlMjUyNTI
yJTI1MjUyMiUyNTI1M0IlMjUyNTBEJTI1MjUwQXdoaWxl
JTI1MjUyODElMjUyQiUyNTI1M0QlMjUyNTNEJTI1MkIxJ
TI1MjUyOSUyNTI1N0IlMjUyNTBEJTI1MjUwQW1lbV9vdm
VybG9hZCUyNTJCJTI1MjUzRCUyNTJCbWVtX292ZXJsb2F
kJTI1MkIlMjUyNTJCJTI1MkIlMjUyNTIyJTI1MkIlMjUy
QiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyN
TJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJT
I1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkI
lMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUy
QiUyNTJCJTI1MjUyMiUyNTI1M0IlMjUyNTBEJTI1MjUwQ
SUyNTI1N0QlMjUyNTBEJTI1MjUwQSUyNTI1N0QlMjUyNT
BEJTI1MjUwQSUyNTI1MEQlMjUyNTBBJTI1MjUwRCUyNTI
1MEElMjUyNTBEJTI1MjUwQSUyNTI1MEQlMjUyNTBBJTI1
MjUwRCUyNTI1MEElMjUyNTBEJTI1MjUwQSUyNTI1MEQlM
jUyNTBBJTI1MjUwRCUyNTI1MEElMjUyNTNDJTI1MjUyRn
NjcmlwdCUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNTI1MEQ
lMjUyNTBBJTI1MjUwRCUyNTI1MEElMjUyNTBEJTI1MjUw
QSUyNTI1MEQlMjUyNTBBJTI1MjUzQ3NjcmlwdCUyNTJCb
GFuZ3VhZ2UlMjUyNTNEJTI1MjUyN2phdmFzY3JpcHQlMj
UyNTI3JTI1MkJzcmMlMjUyNTNEJTI1MjUyMiUyNTI1MjR
zZXJ2ZXIlMjUyNTI4UEhQX1NFTEYlMjUyNTI5JTI1MjUy
NCUyNTI1M0Ztb2RlJTI1MjUzRGNoYXRfanNfdGVybWluY
WwlMjUyNTIyJTI1MjUzRSUyNTI1M0MlMjUyNTJGc2NyaX
B0JTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MjUwRCUyNTI
1MEElMjUyNTNDdGFibGUlMjUyNTNFJTI1MjUwRCUyNTI1
MEElMjUyQiUyNTJCJTI1MjUzQ3RyJTI1MjUzRSUyNTJCJ
TI1MjUwRCUyNTI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQi
UyNTI1M0N0ZCUyNTI1M0UlMjUyQiUyNTI1M0NpZnJhbWU
lMjUyQm5hbWUlMjUyNTNEJTI1MjUyMmNoYXRfdGVybWlu
YWxfZnJhbWUlMjUyNTIyJTI1MkJoZWlnaHQlMjUyNTNEM
jUwJTI1MkJ3aWR0aCUyNTI1M0Q0NjglMjUyNTNFJTI1Mk
IlMjUyNTNDJTI1MjUyRmlmcmFtZSUyNTI1M0UlMjUyQiU
yNTI1M0MlMjUyNTJGdGQlMjUyNTNFJTI1MjUwRCUyNTI1
MEElMjUyQiUyNTJCJTI1MjUzQyUyNTI1MkZ0ciUyNTI1M
0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1MkIlMjUyNTNDdH
IlMjUyNTNFJTI1MkIlMjUyNTBEJTI1MjUwQSUyNTJCJTI
1MkIlMjUyQiUyNTJCJTI1MjUzQ3RkJTI1MjUzRSUyNTJC
JTI1MjUwRCUyNTI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQ
iUyNTJCJTI1MkIlMjUyNTNDZm9ybSUyNTJCbmFtZSUyNT
I1M0QlMjUyNTIyY2hhdF9mb3JtJTI1MjUyMiUyNTJCb25
zdWJtaXQlMjUyNTNEJTI1MjUyMmNoYXRfc2VuZF9tZXNz
YWdlJTI1MjUyOCUyNTI1MjklMjUyNTNCJTI1MkIlMjUyQ
nJldHVybiUyNTJCZmFsc2UlMjUyNTNCJTI1MjUyMiUyNT
I1M0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1MkIlMjUyQiU
yNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyNTNDdGFi
bGUlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyQiUyNTJCJ
TI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1Mk
IlMjUyQiUyNTI1M0N0ciUyNTI1M0UlMjUyQiUyNTI1MEQ
lMjUyNTBBJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUy
NTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJ
TI1MjUzQ3RkJTI1MjUzRSUyNTJCJTI1MjUwRCUyNTI1ME
ElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjU
yQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUy
NTJCJTI1MjUzQ2lucHV0JTI1MkJ0eXBlJTI1MkIlMjUyN
TNEJTI1MkIlMjUyNTIydGV4dCUyNTI1MjIlMjUyQm5hbW
UlMjUyQiUyNTI1M0QlMjUyQiUyNTI1MjJjaGF0X21lc3N
hZ2UlMjUyNTIyJTI1MkJzaXplJTI1MjUzRCUyNTI1MjI1
MCUyNTI1MjIlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyQ
iUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNT
JCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyNTNDJTI1MjU
yRnRkJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MkIlMjUy
QiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyN
TJCJTI1MkIlMjUyQiUyNTJCJTI1MjUzQ3RkJTI1MjUzRS
UyNTJCJTI1MjUwRCUyNTI1MEElMjUyQiUyNTJCJTI1MkI
lMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUy
QiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MjUzQ2lucHV0J
TI1MkJ0eXBlJTI1MkIlMjUyNTNEJTI1MkIlMjUyNTIyYn
V0dG9uJTI1MjUyMiUyNTJCdmFsdWUlMjUyNTNEJTI1MjU
yMlNlbmQlMjUyNTIyJTI1MkJvbmNsaWNrJTI1MjUzRCUy
NTI1MjJjaGF0X3NlbmRfbWVzc2FnZSUyNTI1MjglMjUyN
TI5JTI1MjUyMiUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNT
JCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI
1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1M0MlMjUy
NTJGdGQlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyQiUyN
TJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJT
I1MkIlMjUyQiUyNTI1M0MlMjUyNTJGdHIlMjUyNTNFJTI
1MjUwRCUyNTI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQiUy
NTJCJTI1MkIlMjUyQiUyNTJCJTI1MjUzQyUyNTI1MkZ0Y
WJsZSUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1Mk
IlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1M0MlMjUyNTJ
GZm9ybSUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1
MkIlMjUyQiUyNTJCJTI1MjUzQyUyNTI1MkZ0ZCUyNTI1M
0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1MkIlMjUyNTNDJT
I1MjUyRnRyJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MjU
zQyUyNTI1MkZ0YWJsZSUyNTI1M0UlMjUyNTBEJTI1MjUw
QSUyNTI1MEQlMjUyNTBBJTI1MjUzQyUyNTI1MkZib2R5J
TI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MjUwRCUyNTI1ME
ElMjUyNTNDJTI1MjUyRmh0bWwlMjUyNTNFJTBBY2hhdF9
sb2dpbi5odG0lMjUwQXMlMjUyNTNDaHRtbCUyNTI1M0Ul
MjUyNTBEJTI1MjUwQSUyNTI1M0NoZWFkJTI1MjUzRSUyN
TI1MEQlMjUyNTBBJTI1MjUzQ3RpdGxlJTI1MjUzRVVudG
l0bGVkJTI1MkJEb2N1bWVudCUyNTI1M0MlMjUyNTJGdGl
0bGUlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyNTNDbWV0
YSUyNTJCaHR0cC1lcXVpdiUyNTI1M0QlMjUyNTIyQ29ud
GVudC1UeXBlJTI1MjUyMiUyNTJCY29udGVudCUyNTI1M0
QlMjUyNTIydGV4dCUyNTI1MkZodG1sJTI1MjUzQiUyNTJ
CY2hhcnNldCUyNTI1M0Rpc28tODg1OS0xJTI1MjUyMiUy
NTI1M0UlMjUyNTBEJTI1MjUwQSUyNTI1M0MlMjUyNTJGa
GVhZCUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNTI1MEQlMj
UyNTBBJTI1MjUzQ2JvZHklMjUyQmJnY29sb3IlMjUyNTN
EJTI1MjUyMiUyNTI1MjNGRkZGRkYlMjUyNTIyJTI1MkJ0
ZXh0JTI1MjUzRCUyNTI1MjIlMjUyNTIzMDAwMDAwJTI1M
jUyMiUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNTI1M0NkaX
YlMjUyQmFsaWduJTI1MjUzRCUyNTI1MjJjZW50ZXIlMjU
yNTIyJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MkIlMjUy
QiUyNTI1M0Nmb3JtJTI1MkJuYW1lJTI1MjUzRCUyNTI1M
jJmb3JtMSUyNTI1MjIlMjUyQm1ldGhvZCUyNTI1M0QlMj
UyNTIycG9zdCUyNTI1MjIlMjUyQmFjdGlvbiUyNTI1M0Q
lMjUyNTIyJTI1MjUyNHNlcnZlciUyNTI1MjhQSFBfU0VM
RiUyNTI1MjklMjUyNTI0JTI1MjUzRm1vZGUlMjUyNTNEY
2hhdF9sb2dpbiUyNTI1MjIlMjUyNTNFJTI1MjUwRCUyNT
I1MEElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1M0N0YWJ
sZSUyNTJCYm9yZGVyJTI1MjUzRCUyNTI1MjIwJTI1MjUy
MiUyNTJCY2VsbHNwYWNpbmclMjUyNTNEJTI1MjUyMjAlM
jUyNTIyJTI1MkJjZWxscGFkZGluZyUyNTI1M0QlMjUyNT
IyMyUyNTI1MjIlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjU
yQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyNTND
dHIlMjUyNTNFJTI1MkIlMjUyNTBEJTI1MjUwQSUyNTJCJ
TI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1Mk
IlMjUyNTNDdGQlMjUyQmNvbHNwYW4lMjUyNTNEJTI1MjU
yMjIlMjUyNTIyJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1
MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlM
jUyQiUyNTJCJTI1MkIlMjUyNTNDZGl2JTI1MkJhbGlnbi
UyNTI1M0QlMjUyNTIyY2VudGVyJTI1MjUyMiUyNTI1M0U
lMjUyNTNDYiUyNTI1M0UlMjUyNTNDZm9udCUyNTJCc2l6
ZSUyNTI1M0QlMjUyNTIyMyUyNTI1MjIlMjUyNTNFUGxlY
XNlJTI1MkJzZWxlY3QlMjUyQmElMjUyQnVzZXJuYW1lJT
I1MjUzQyUyNTI1MkZmb250JTI1MjUzRSUyNTI1M0MlMjU
yNTJGYiUyNTI1M0UlMjUyNTNDJTI1MjUyRmRpdiUyNTI1
M0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1MkIlMjUyQiUyN
TJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyNTNDJTI1Mj
UyRnRkJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MkIlMjU
yQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MjUzQyUyNTI1
MkZ0ciUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNTJCJTI1M
kIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1M0N0ciUyNT
I1M0UlMjUyQiUyNTI1MEQlMjUyNTBBJTI1MkIlMjUyQiU
yNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1
M0N0ZCUyNTI1M0VVc2VyJTI1MkJOYW1lJTI1MjUzQSUyN
TI1M0MlMjUyNTJGdGQlMjUyNTNFJTI1MjUwRCUyNTI1ME
ElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjU
yQiUyNTJCJTI1MjUzQ3RkJTI1MjUzRSUyNTJCJTI1MjUw
RCUyNTI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJ
TI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1M0Npbn
B1dCUyNTJCdHlwZSUyNTI1M0QlMjUyNTIydGV4dCUyNTI
1MjIlMjUyQm5hbWUlMjUyNTNEJTI1MjUyMmNoYXRfdXNl
cm5hbWUlMjUyNTIyJTI1MkJtYXhsZW5ndGglMjUyNTNEJ
TI1MjUyMjI1JTI1MjUyMiUyNTJCc2l6ZSUyNTI1M0QlMj
UyNTIyMjUlMjUyNTIyJTI1MjUzRSUyNTI1MEQlMjUyNTB
BJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1
MkIlMjUyQiUyNTI1M0MlMjUyNTJGdGQlMjUyNTNFJTI1M
jUwRCUyNTI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNT
JCJTI1MkIlMjUyNTNDJTI1MjUyRnRyJTI1MjUzRSUyNTI
1MEQlMjUyNTBBJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUy
QiUyNTJCJTI1MjUzQ3RyJTI1MjUzRSUyNTJCJTI1MjUwR
CUyNTI1MEElMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJT
I1MkIlMjUyQiUyNTJCJTI1MjUzQ3RkJTI1MkJjb2xzcGF
uJTI1MjUzRCUyNTI1MjIyJTI1MjUyMiUyNTI1M0UlMjUy
QiUyNTI1MEQlMjUyNTBBJTI1MkIlMjUyQiUyNTJCJTI1M
kIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMj
UyNTNDZGl2JTI1MkJhbGlnbiUyNTI1M0QlMjUyNTIyY2V
udGVyJTI1MjUyMiUyNTI1M0UlMjUyQiUyNTI1MEQlMjUy
NTBBJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJ
TI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJTI1Mj
UzQ2lucHV0JTI1MkJ0eXBlJTI1MjUzRCUyNTI1MjJoaWR
kZW4lMjUyNTIyJTI1MkJuYW1lJTI1MjUzRCUyNTI1MjJ0
cnklMjUyNTIyJTI1MkJ2YWx1ZSUyNTI1M0QlMjUyNTIye
SUyNTI1MjIlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyQi
UyNTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJ
CJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyNTNDaW5wdXQl
MjUyQnR5cGUlMjUyNTNEJTI1MjUyMnN1Ym1pdCUyNTI1M
jIlMjUyQm5hbWUlMjUyNTNEJTI1MjUyMlN1Ym1pdCUyNT
I1MjIlMjUyQnZhbHVlJTI1MjUzRCUyNTI1MjJMb2dpbiU
yNTI1MjIlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyQiUy
NTJCJTI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTJCJ
TI1MkIlMjUyQiUyNTI1M0MlMjUyNTJGZGl2JTI1MjUzRS
UyNTI1MEQlMjUyNTBBJTI1MkIlMjUyQiUyNTJCJTI1MkI
lMjUyQiUyNTJCJTI1MkIlMjUyQiUyNTI1M0MlMjUyNTJG
dGQlMjUyNTNFJTI1MjUwRCUyNTI1MEElMjUyQiUyNTJCJ
TI1MkIlMjUyQiUyNTJCJTI1MkIlMjUyNTNDJTI1MjUyRn
RyJTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MkIlMjUyQiU
yNTJCJTI1MkIlMjUyNTNDJTI1MjUyRnRhYmxlJTI1MjUz
RSUyNTI1MEQlMjUyNTBBJTI1MkIlMjUyQiUyNTI1M0MlM
jUyNTJGZm9ybSUyNTI1M0UlMjUyNTBEJTI1MjUwQSUyNT
JCJTI1MkIlMjUyNTBEJTI1MjUwQSUyNTI1M0MlMjUyNTJ
GZGl2JTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1MjUzQyUy
NTI1MkZib2R5JTI1MjUzRSUyNTI1MEQlMjUyNTBBJTI1M
jUzQyUyNTI1MkZodG1sJTI1MjUzRSUyNTI1MEQlMjUyNT
BB';
global $virtual_files;
function get_virtual_file($file){
	global $virtual_files;
	$virtual_file_data = new data_wiz();
	$virtual_file_data->load_vars(base64_decode(preg_replace("/\s/", '', $virtual_files)));
	return $virtual_file_data->get_var($file);
}




#--------------------------------- General Functions


function param($variable, $default="") {
	$form_vars = array_merge($_GET, $_POST);
	if(array_key_exists($variable, $form_vars) == false){
		return $default;
	}
	if($form_vars[$variable] == ''){
		return $default;
	}
	if(is_array($form_vars[$variable])){
		return $form_vars[$variable];
	} 
	return stripslashes($form_vars[$variable]);
}



function safe_html($data){
$data = preg_replace("/script/is", "_script_", $data);
$data  =  preg_replace("/\\</s", "&lt;", $data);
return preg_replace("/\\>/s", "&gt;", $data);
}


#--------------------------------- Data wiz



class data_wiz {
	
	function data_wiz(){
		$this->vars = array();
	}
	
	function set_var($key, $value){
		$this->vars[$key] = $value;
	}
	
	function get_var($key, $default=''){
		if(isset($this->vars[$key])){
		 return $this->vars[$key];
		}
		return $default;
	}
	

	
	function dump_vars() {
		return $this->dump_vars_recursive($this->vars);
	}
	
	function dump_vars_recursive($data) {
		if(is_array($data)){
			$out_array = array();
			foreach($data as $key => $value){
				$key = urlencode($key);
				$value = $this->dump_vars_recursive($value);
				$pair = urlencode("$key\n$value");
				array_push($out_array, $pair);
			}
			return 'a' . urlencode(implode("\n", $out_array));
		} else {
			return 's' . urlencode($data);
		}
 	
	}	


	function load_vars($data){
		if($data == ''){
			$this->vars = array();
		} else {
			$this->vars = array();
			$this->vars = $this->load_vars_recursive($data);
		}
	}
	
	function load_vars_recursive($data){
		//get type
		preg_match("/^(.)(.*)/", $data, $matches);
		$type = $matches[1];
		$data = $matches[2];
		if($type == 'a'){
			
			if($data == ''){
				return array();
			}
			$out_array = array();
			//unfold lines
			$data = urldecode($data);
			//get array
			$data_array = preg_split("/\n/s", $data);
			foreach($data_array as $pair){
				//unfold pair
				$pair = urldecode($pair);
				//get array
				$pair_array = preg_split("/\n/s", $pair);
				$key = urldecode($pair_array[0]);
				$value = $this->load_vars_recursive($pair_array[1]);
				$out_array[$key] = $value;
			}
			return $out_array;
		} else {
			return urldecode($data);
		}
		
	}

}


#--------------------------------- Template wiz


class template_wiz {
	
	function template_wiz($start_file = "", $start_section = ""){
		$this->file_cache = array();
		$this->section_cache = array();
		$this->template = "";
		$this->current_file = $start_file;
		$this->load_template($start_file, $start_section);
		
		$this->var_list = array();
		$this->function_list = array();
		$this->mode_list = array();
		$this->pre_list = array();
		$this->post_list = array();
		
		
		$this->import_function('this->param', 'param');
		$this->import_function('this->server', 'server');
		$this->import_function('this->safe_var', 'safe_var');
		$this->import_function('this->html_var', 'html_var');
		$this->import_function('this->text_padding', 'text_padding');
		$this->import_function('this->dynamic_function', 'function');
		
	}
	
	function html_char_sub($char) {
			if($char == '<') {
				return '&lt;';
			}
			if($char == '>') {
				return '&gt;';
			}
			if($char == "\n") {
				return '<br>';
			}
		}
	
	
		
		function html_var($args){
		if(sizeof($args) > 0){
		$name = $args[0];
		} else {
			$this->template_wiz_error("No variable was specified in function 'html_var'.");
		}
		if(array_key_exists($name, $this->var_list) == false){
			$this->template_wiz_error("no such var \"$name\" has been imported (called from function 'html_var')");
		}
	
		return preg_replace("/([\\n\\<\\>])/es", "\$this->html_char_sub('\\1')", $this->var_list[$name]);
	}
		
	function text_padding($args){
		$key = $args[0];
		$max_size = $args[1];
		$value = $this->var_list[$key];
		if(strlen($value) > $max_size){
			$value = substr($value, 0, $max_size - 3) . '...';
		} else {
			$value = str_pad($value, $max_size, " ");
		}
		return $value;
	}

	
	function safe_var($args){
		if(sizeof($args) > 0){
		$name = $args[0];
		$max_length = -1;
		} else {
			$this->template_wiz_error("No variable was specified in function 'safe_var'.");
		}
		if(sizeof($args) > 1){
			$max_length = $args[1];
		}
		
		if(array_key_exists($name, $this->var_list) == false){
			$this->template_wiz_error("no such var \"$name\" has been imported (called from function 'safe_var')");
		}
		$out = $this->var_list[$name];
		if((strlen($out) > $max_length)&&($max_length > 0)){
			$out = substr($out, 0, $max_length) . '...'; 
		}
		$out = preg_replace("/php/is", "&#112;&#104;&#112;", $out);
		$out =  preg_replace("/\\</s", "&lt;", $out);
		return preg_replace("/\\>/s", "&gt;", $out);
	}
	
	function dynamic_function($args){
		if(sizeof($args) > 0){
		$function = array_shift($args);
		} else {
			$this->template_wiz_error("No function name was specified in function 'function'.");
		}
		//make sure function has been imported
		if(array_key_exists($function, $this->function_list) == false){
			$this->template_wiz_error("no such function \"$function\" has been imported (called from function 'function')");
		}
		//substite each variable and make sure each one has been imported
		$sub_vars = array();
		foreach($args as $value){
			if(array_key_exists($value, $this->var_list) == false){
			$this->template_wiz_error("no such var \"$value\" has been imported (called from function 'function')");
			} 
			array_push($sub_vars, $this->var_list[$value]);
		}
		
		//actually run the function
		if(preg_match("/^(\\S+)->(\\S+)\$/", $function, $results)){
			$object_name = $results[1];
			$function_name = $results[2];
			return $$object_name->$function_name($sub_vars);
		} else {
			$function_name = $function;
			return $function_name($sub_vars);
		}
		
		
	}
	
	function server($args){
		$name = '';
		$default= '';
		if(sizeof($args) > 0){
		$name = $args[0];
		} else {
			return '';
		}
		if(sizeof($args) > 1){
		$default = $args[1];
		}
		if(array_key_exists($name, $_SERVER) == false){
			return $default;
		}
		
		$value = $_SERVER[$name];
		if($value == ''){
			return $default;
		}
		return $value;
	}
	
	function param($args){
		$name = '';
		$default= '';
		if(sizeof($args) > 0){
		$name = $args[0];
		} else {
			return '';
		}
		if(sizeof($args) > 1){
		$default = $args[1];
		}
		$form_vars = array_merge($_GET, $_POST);
		if(array_key_exists($name, $form_vars) == false){
			return $default;
		}
		
		$value = $form_vars[$name];
		if($value == ''){
			return $default;
		}
		$value = stripslashes($value);
		$value = preg_replace("/([\\<\\>])/es", "\$this->safe_char_sub('\\1')", $value);
		return $value;
	}
	
	function load_template($file, $section=""){
		$this->load_file($file);
		$this->load_section($section);
	}
	
	function load_file($file){
		$vfile = get_virtual_file($file);
		if($vfile != ''){
			$this->template = $vfile;
			return '';
		}
		
		if(strcmp($file, "") == 0){
		$this->template = "";
		return '';
		}
		
		if(is_file($file) == false){
			$this->template_wiz_error("file \"$file\" does not exist.");
		}
	if(array_key_exists($file, $this->file_cache) == false){
	$fp = fopen($file, "rb");
	$this->file_cache[$file] =	fread($fp, filesize($file));
	fclose($fp);
	}
	$this->current_file = $file;
	$this->template = $this->file_cache[$file];
	}
	
	function preload_sections(){
		if(array_key_exists($this->current_file, $this->section_cache) == false){
			$file_lines = preg_split("/\\n/", $this->file_cache[$this->current_file]);
			$tag_line = "";
			$section_name = "";
			$section_data = array();
			$sections_out = array();
			foreach($file_lines as $line){
				if(preg_match("/^([^\\s\\:]+)\\:\\s*\$/s", $line, $tag_line)){
					if(strcmp($section_name, "") != 0){
						$sections_out[$section_name] = implode("\n", $section_data);
					}
				$section_name = $tag_line[1];
					$section_data = array();
					
				} else {
					array_push($section_data, $line);
				}
				if(strcmp($section_name, "") != 0){
					$sections_out[$section_name] = implode("\n", $section_data);
				}
				$this->section_cache[$this->current_file] = $sections_out;
			}
		}
	}
	
	
	
	function load_section($section){
	if(strcmp($this->current_file, "") == 0){
		return;
	}
		if(strcmp($section, "") == 0){
		return;
	}
	
	$this->preload_sections();

	if(array_key_exists($section, $this->section_cache[$this->current_file])){
		$this->template = $this->section_cache[$this->current_file][$section];
	}else {
		$this->template_wiz_error("no such section \"$section\" in file \"$this->current_file\".");
	}
	
	}	
	
	
	function set_template($template_data){
		$this->template = $template_data;
		
	}
	
	
	
	function parse_args($args){
		$args = stripslashes($args);
		$args = preg_replace("/\\&([^\\;\\s$]{1,4})\\;/se", "\$this->decode_html_special_char('\\1')", $args);
		$in_double_quote = false;
		$in_single_quote = false;
		$current_var_array = array();
		$out = array();
		for($x = 0; $x < strlen($args); $x++){
			$current_char =  substr($args, $x, 1);
			if((strcmp($current_char, "\"") == 0)&&($in_double_quote == false)&&($in_single_quote == false)){
				$in_double_quote = true;
			}elseif((strcmp($current_char, "'") == 0)&&($in_double_quote == false)&&($in_single_quote == false)){
				$in_single_quote = true;
			}elseif((strcmp($current_char, ",") == 0)&&($in_double_quote == false)&&($in_single_quote == false)){
				array_push($out, implode('', $current_var_array));
				$current_var_array = array();
			}elseif((strcmp($current_char, "\"") == 0)&&($in_double_quote == true)&&($in_single_quote == false)){
				$in_double_quote = false;
			}elseif((strcmp($current_char, "'") == 0)&&($in_double_quote == false)&&($in_single_quote == true)){
				$in_single_quote = false;
			}elseif((strcmp($current_char, "\\") == 0)&&($in_double_quote == true)){
				array_push($current_var_array, $this->decode_escape_char(substr($args, $x + 1, 1)));
				$x++;
			}elseif((strcmp($current_char, " ") == 0)&&($in_double_quote == false)&&($in_single_quote == false)){
			//do nothing
			}else{
			array_push($current_var_array, $current_char);
			}
		}
		if(sizeof($current_var_array) > 0){
			array_push($out, implode('', $current_var_array));
		}
		return $out;
	}
	
	function decode_html_special_char($data){
	if(strcmp(strtolower($data), "lt") == 0){
			return '<';
	}
	if(strcmp(strtolower($data), "gt") == 0){
			return '>';
	}
	if(strcmp(strtolower($data), "amp") == 0){
			return '&';
	}
	if(strcmp(strtolower($data), "quot") == 0){
			return '"';
	}
	return preg_replace("/^\\#(\\d\\d\\d)/se", "chr(intval('\\1'))", $data);
	return '';
	}
	
	
	
	function decode_escape_char($char) {
	if(strcmp(strtolower($char), "n") == 0){
			return "\n";
	}
	if(strcmp(strtolower($char), "d") == 0){
			return "\$";
	}
	if(strcmp(strtolower($char), "h") == 0){
			return "#";
	}
	if(strcmp(strtolower($char), "[") == 0){
			return "(";
	}
	if(strcmp(strtolower($char), "]") == 0){
			return ")";
	}
	return $char;
	}
	
	
	
	
	
	function html_unescape($data){
		#convert normal html special chars into plain text
		$data = preg_replace("/\\&([^\\;\\s\\$]{1,4})\\;/se", "\$this->get_html_special_char('\\1')", $data);
		return preg_replace("/\\\\(.)/se", "\$this->get_escape_char('\\1')", $data);
	}
	
	
	function run_function($function_name, $function_args) {
		if(array_key_exists( $function_name, $this->function_list) == false){
			$this->template_wiz_error("no such function \"$function_name\" has been imported");
		}
		$function_args_array = $this->parse_args($function_args);
		if(preg_match("/^(\\S+)->(\\S+)\$/", $this->function_list[$function_name], $results)){
			$object_name = $results[1];
			$function_name = $results[2];
			if($object_name == 'this'){
			return $this->$function_name($function_args_array);
			} else {
			return $$object_name->$function_name($function_args_array);
			}
		} else {
			$function_name = $this->function_list[$function_name];
			return $function_name($function_args_array);
		}
	}
	
	function get_var($name) {
		if(array_key_exists($name, $this->var_list)){
			return $this->var_list[$name];
		} else {
		$this->template_wiz_error("no such var \"$name\" has been imported");
	}
	}
	
	function run_sub($var1, $var2="", $var3=""){
	if(strcmp($var3, '') != 0){
		return $this->get_var($var3);
	} else {
		return $this->run_function($var1, $var2);
	}
	}
	
	
	function run(){
	$temp_template = $this->template;
	$temp_template = $this->run_pre($temp_template);
	$temp_template =  preg_replace("/\\$([^\\(\\$]+)\\(([^\\)\\$]*)\\)\\$|\\$([^\\$\\s]+)([^\\$]*)\\$/se", "\$this->run_sub('\\1', '\\2', '\\3')", $temp_template);
	return $this->run_post($temp_template);
	}
	
	function template_wiz_error($error){
		echo "<html><body bgcolor=\"#ffffff\"><hr><font face=\"verdana\" size=2><b>template_wiz error:</b> <i>$error</i></font><hr></body></html>";
		exit;
	}
	
	function run_modes(){
	$form_vars = array_merge($_GET, $_POST);
	if(array_key_exists('mode', $form_vars) == false){
		return '';
	}
	if(array_key_exists($form_vars['mode'], $this->mode_list) == false){
		$this->template_wiz_error("no such mode \"{$form_vars['mode']}\" has been imported.");
	}
	$function = $this->mode_list[$form_vars['mode']];
	if(preg_match("/^(\\S+)->(\\S+)\$/", $function, $results)){
			$object_name = $results[1];
			$function_name = $results[2];
			if($object_name == 'this'){
			$this->$function_name($data);
			} else {
			$$object_name->$function_name($data);
			}
		} else {
			$function_name = $function;
			$function_name();
		}
	}
	
	function run_pre($data) {
		foreach($this->pre_list as $function){
		if(preg_match("/^(\\S+)->(\\S+)\$/", $function, $results)){
			$object_name = $results[1];
			$function_name = $results[2];
			if($object_name == 'this'){
			$data = $this->$function_name($data);
			} else {
			$data = $$object_name->$function_name($data);
		}
		} else {
			$function_name = $function;
			$data = $function_name($data);
		}
		}
		return $data;
	}
	
	function run_post($data){
		foreach($this->post_list as $function){
			if(preg_match("/^(\\S+)->(\\S+)\$/", $function, $results)){
			$object_name = $results[1];
			$function_name = $results[2];
			if($object_name == 'this'){
			$data = $this->$function_name($data);
			} else {
			$data = $$object_name->$function_name($data);
		}
		} else {
			$function_name = $function;
			$data = $function_name($data);
		}
		}
		return $data;
	}
	
	

	
	function import_var($var_name, $var_value){
		$this->var_list[$var_name] = $var_value;
	}
	
	function import_function($function_name, $function_alias=""){
		if(strcmp($function_alias, "") == 0){
			$function_alias = $function_name;
		}
		$this->function_list[$function_alias] = $function_name;
	}
	
		function import_mode($function_name, $function_alias=""){
		if(strcmp($function_alias, "") == 0){
			$function_alias = $function_name;
		}
		$this->mode_list[$function_alias] = $function_name;
	}
	
	function import_pre($function_name){
		array_push($this->pre_list, $function_name);
	}
	
	function import_post($function_name){
		array_push($this->post_list, $function_name);
	}
	
	
	
	function import_object($tw_object){
		foreach($tw_object->function_list as $function_alias){
			$this->function_list[$function_alias] = $tw_object->function_list[$function_alias];
		}
		foreach($tw_object->mode_list as $function_alias){
			$this->mode_list[$function_alias] = $tw_object->mode_list[$function_alias];
		}
	}
	
function rip_body(){
if(preg_match("/<body([^>]*)>(.*)<\\/body>/is", $this->template, $matches)){
$this->template = $matches[2];
} elseif(preg_match("/<body([^>]*)>(.*)<\\/html>/is", $this->template, $matches)){
$this->template = $matches[2];
}
}

function javascript_charhex($char){
	$char_hex = dechex(ord(stripslashes($char)));
	if(strlen($char_hex) < 2){
		$char_hex = '0' . $char_hex;
	}
	return "\\x$char_hex";
}

function javascript_string_escape($string){
	return preg_replace("/(.)/se", '$this->javascript_charhex("\\1")', $string);
}

function alert($message){
	$message = $this->javascript_string_escape($message);
	$script = "<script language = \"javascript\">\nalert(\"$message\");\n</script>\n";
	if(preg_match("/(<body[^>]>)/", $this->template)){
		$this->template = preg_replace("/(<body[^>]>)/", $script, $this->template);
	} else {
		$this->template = $this->template . $script;
	}
}

function sections(){
	$this->preload_sections();
	return array_keys($this->section_cache[$this->current_file]);
}


}


function chat_login(){
	$this_page = new template_wiz("chat_template.htm");
	$main = new template_wiz("chat_login.htm");
	$main->rip_body();

	
	$try = param('try', 'n');
	$chat_messages = new data_wiz();

	if($try == 'n'){
		$logged_in = true;
		//make sure there is a user name password set
		if(isset($_COOKIE['chat_username'])&&isset($_COOKIE['chat_password'])){
			$chat_password = md5($_COOKIE['chat_password']);
			$chat_username = $_COOKIE['chat_username'];
			
			$fh = fopen("chat_messages.txt", 'r+b');
			flock($fh, LOCK_EX);
			fseek($fh, 0, SEEK_END); 
			$filesize = ftell($fh);
			rewind($fh);
			$current_data = "";
			if($filesize > 0){
				$current_data = fread($fh, $filesize);
			}
			flock($fh, LOCK_UN);
			$chat_messages->load_vars($current_data);
			$users = $chat_messages->get_var('users', array());
		
			if(isset($users[$chat_username])) {
				$user_array = $users[$chat_username];
				
				if($user_array['password'] != $chat_password){
					$logged_in = false;
				} 
			} else {
				$logged_in = false;
			}
		} else {
			$logged_in = false;
		}


		if(!$logged_in){
			$this_page->import_var('chat', $main->run());
			echo $this_page->run();
			exit;
		}
	} else {
		$chat_username = trim(param('chat_username'));
		if($chat_username != ''){
			if(!preg_match("/\s/", $chat_username)){
				$chat_password = floor(rand(0, 999)) . floor(rand(0, 999)) . floor(rand(0, 999)) . floor(rand(0, 999)) . floor(rand(0, 999));
	
				$fh = fopen("chat_messages.txt", 'r+b');
				flock($fh, LOCK_EX);
				fseek($fh, 0, SEEK_END); 
				$filesize = ftell($fh);
				rewind($fh);
				$current_data = "";
				if($filesize > 0){
					$current_data = fread($fh, $filesize);
				}
				rewind($fh);
				$chat_messages->load_vars($current_data);
			
			
				$users = $chat_messages->get_var('users', array());
				$current_message_id = $chat_messages->get_var('current_message_id', 0);
				$message_list = $chat_messages->get_var('message_list', array());
		
		
				if(!isset($users[$chat_username])){
					$user_array = array();
					$user_array['password'] = md5($chat_password);
					$user_array['time'] = time();
					$users[$chat_username] = $user_array;
					$chat_messages->set_var('users', $users);
					fwrite($fh, $chat_messages->dump_vars());
					fclose($fh);
					setcookie('chat_username', $chat_username);
					setcookie('chat_password', $chat_password);
					header("Location: {$_SERVER['PHP_SELF']}");
					exit;
				} else {
					$this_page->alert("There is already a user logged with this name - please try again");
					$this_page->import_var('chat', $main->run());
					echo $this_page->run();
					exit;
				}
				
			} else {
				$this_page->alert("Your user name can't contain spaces  - please try again");
				$this_page->import_var('chat', $main->run());
				echo $this_page->run();
				exit;
			}
		
		} else {
			$this_page->alert("You did not give a user name  - please try again");
			$this_page->import_var('chat', $main->run());
			echo $this_page->run();
			exit;
		}
	}
	
}


function chat_main(){
	chat_login();
	
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	$this_page = new template_wiz("chat_template.htm");
	$main = new template_wiz("chat.htm");
	$main->rip_body();
	$this_page->import_var('chat', $main->run());
	echo $this_page->run();
	exit;
}


function javascript_charhex($char){
	$char_hex = dechex(ord(stripslashes($char)));
	if(strlen($char_hex) < 2){
		$char_hex = '0' . $char_hex;
	}
	return "\\x$char_hex";
}

function javascript_string_escape($string){
	return preg_replace("/(.)/se", 'javascript_charhex("\\1")', $string);
}


function chat_js_terminal(){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	global $check_rate;
	
	$old_message_id = param('old_message_id', -1);

	$fh = fopen("chat_messages.txt", 'r+b');

	$chat_messages = new data_wiz();
	
	if($old_message_id == -1){
	
		//initialise vars
		flock($fh, LOCK_EX);
		fseek($fh, 0, SEEK_END); 
		$filesize = ftell($fh);
		rewind($fh);
		$current_data = "";
		if($filesize > 0){
			$current_data = fread($fh, $filesize);
		}
		flock($fh, LOCK_UN);
		$chat_messages->load_vars($current_data);
		$current_message_id = $chat_messages->get_var('current_message_id', 0);
		$old_message_id = $current_message_id;
	
	} else {
 	    
	
		flock($fh, LOCK_EX);
		fseek($fh, 0, SEEK_END); 
		$filesize = ftell($fh);
		rewind($fh);
		$current_data = "";
		if($filesize > 0){
			$current_data = fread($fh, $filesize);
		}
		flock($fh, LOCK_UN);
		$chat_messages->load_vars($current_data);
		$chat_messages->load_vars($current_data);
		$current_message_id = $chat_messages->get_var('current_message_id', 0);
		$message_list = $chat_messages->get_var('message_list', array());
		
		if($current_message_id > $old_message_id){
			for($x = $old_message_id + 1; $x <= $current_message_id; $x++){
				if(isset($message_list[$x])){
				$message_array = $message_list[$x];
				$message = $message_array['data'];
					if(preg_match("/^#(.*)/", $message, $matches)){
						chat_function($matches[1]);
					} else {
						$message = javascript_string_escape($message);
						echo "window.setTimeout('append_chat_terminal(\"{$message}\");', 1)\n";
					}
				}
			}
		}
		
		$old_message_id = $current_message_id;
	}

?>

window.setTimeout('refresh_chat_terminal(<? echo $old_message_id; ?>);', <? echo 1000 * $check_rate; ?>);
<?


}


function chat_js_send_message(){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	$message = param('message');

	$fh = fopen("chat_messages.txt", 'r+');
	flock($fh, LOCK_EX);


	$chat_password = md5($_COOKIE['chat_password']);
	$chat_username = $_COOKIE['chat_username'];

	$chat_messages = new data_wiz();

	//initialise vars


	$filesize = filesize("chat_messages.txt");
      
	$current_data = "";            
	if($filesize > 0){
		$current_data = fread($fh, $filesize);
	}
    

	$chat_messages->load_vars($current_data);
	$current_message_id = $chat_messages->get_var('current_message_id', 0);
	$message_list = $chat_messages->get_var('message_list', array());
	$current_message_id = $current_message_id + 1;
	$users = $chat_messages->get_var('users', array());
	if(!isset($users[$chat_username])){
		echo "window.setTimeout('chat_logged_out();', 1)\n";
		exit;
	}

	if($users[$chat_username]['password'] != $chat_password){
		echo "window.setTimeout('chat_logged_out();', 1)\n";
		exit;
	}

	$time = time();

	$users[$chat_username]['time'] = $time;

	$message_array = array();
	$chat_username = safe_html($chat_username);
	if(preg_match("/^(#.*)/", $message)){
		$message_array['data'] = $message;
	} else {
		$message = safe_html($message);
		$message_array['data'] = "<b>{$chat_username} &gt;</b> " . $message . "<br>";
	}
	$message_array['time'] = $time;

	$message_list[$current_message_id] = $message_array;

	//remove any messages older than a minute
	$purged_message_list = array();
	foreach($message_list as $key => $message_array){
		if($message_array['time'] >= $time - 60){
			$purged_message_list[$key] = $message_array;
		}
	}

//remove any uers older than a 10 minutes
	$purged_users = array();
	foreach($users as $key => $users_array){
		if($users_array['time'] >= $time - 600){
			$purged_users[$key] = $users_array;
		}
	}

	$chat_messages->set_var('current_message_id', $current_message_id);
	$chat_messages->set_var('message_list', $purged_message_list);
	$chat_messages->set_var('users', $purged_users);
	rewind($fh);

	fwrite($fh, $chat_messages->dump_vars());
	flush();
}

function chat_function($function_string) {
	global $moderator_password;
	global $moderator_kick;
	global $moderator_bomb;
	
	$args = preg_split("/\s+/", trim($function_string));
	$function_name = array_shift($args);
	$password = array_shift($args);
	$username = array_shift($args);
	if($password != $moderator_password){
		return;
	}
	
	if($function_name == 'kick'){
		chat_kick($username);
	}
	
	if($function_name == 'bomb'){
		chat_bomb($username);
	}
}

function chat_kick($username){
	global $moderator_kick;
	if($moderator_kick == true){
		if($username == $_COOKIE['chat_username']){
			setcookie('chat_password', '');
			echo "window.setTimeout('chat_kick_user();', 1)\n";
		}
	}
}

function chat_bomb($username){
	global $moderator_bomb;
	if($moderator_bomb == true){
		if($username == $_COOKIE['chat_username']){
			echo "window.setTimeout('chat_bomb_user();', 1)\n";
		}
	}
}



$mode = param('mode', 'chat_main');


if($mode == 'chat_main'){
	chat_main();
} elseif($mode == 'chat_login') {
	chat_login();
} elseif($mode == 'chat_js_send_message'){
	chat_js_send_message();
} elseif($mode == 'chat_js_terminal'){
	chat_js_terminal();
}




?>


