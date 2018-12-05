let SessionLoad = 1
if &cp | set nocp | endif
let s:so_save = &so | let s:siso_save = &siso | set so=0 siso=0
let v:this_session=expand("<sfile>:p")
silent only
silent tabonly
exe "cd " . escape(expand("<sfile>:p:h"), ' ')
if expand('%') == '' && !&modified && line('$') <= 1 && getline(1) == ''
  let s:wipebuf = bufnr('%')
endif
set shortmess=aoO
badd +1 config/config.php
badd +1 index.php
badd +106 core/loader.php
badd +1 core/controller.php
badd +42 core/view.php
badd +1 app/entity/user.php
badd +1 config/database.php
badd +1 app/controllers/home.php
badd +4 app/html/home.html
badd +35 core/core.php
badd +1 core/modules.php
badd +64 core/db.php
badd +1 app/views/home.php
badd +1 app/html/layout/default.html
badd +1 app/html/prompter.html
badd +1 app/html/header.html
badd +132 app/assets/css/style.css
badd +6 ~/cursus/camagru/app/controllers/login.php
badd +1 app/html/login/login.html
badd +33 ~/cursus/camagru/app/script/php/login.php
badd +78 app/models/sql_test.php
badd +28 core/modules/session/v_session.php
badd +72 core/modules/session/c_session.php
badd +9 core/modules/session/html/register.html
badd +2 app/sql/seed/user.sql
badd +46 app/sql/seed/user_gender.sql
badd +139 app/sql/tables.sql
badd +16 app/controllers/setup.php
badd +3 app/sql/seed/tag.sql
badd +7 app/models/setup.php
badd +19 core/modules/session/m_session.php
badd +16 app/controllers/register.php
badd +40 app/controllers/login.php
badd +1 core/modules/modules.php
badd +2 app/sql/seed/user_gender_identity.sql
badd +2 core/modules/session/html/login.html
badd +3 core/modules/session/html/forgot_password.html
badd +2 app/views/login.php
badd +6 app/views/register.php
badd +1 app/html/forgot_password.php
badd +1 app/html/forgot_password.html
badd +1 core/modules/session/html/loggued.html
badd +1 core/modules/email/c_email.php
badd +1 app/controllers/sql_test.php
badd +7 app/views/setup.php
badd +3 app/views/sql_test.php
badd +1 app/html/change_password.htmp
badd +1 app/html/change_password.html
badd +1 core/modules/session/html/change_password.html
badd +1 core/modules/modules_view.php
badd +1 app/html/account.html
badd +1 core/modules/websocket/class.chathandler.php
badd +2 core/modules/websocket/html/chat.html
badd +1 core/modules/websocket/web_socket_serveur.php
badd +1 core/modules/websocket/c_websocket.php
badd +1 core/modules/websocket/v_websocket.php
badd +1 core/modules/websocket/start_server.sh
badd +2 app/sql/seed/like(1).sql
badd +2 app/sql/seed/like(2).sql
badd +1 app/sql/seed/like(3).sql
badd +1 app/sql/seed/like43).sql
badd +1 app/sql/seed/like(4).sql
badd +1 app/sql/seed/like(5).sql
badd +1 app/sql/seed/like(6).sql
badd +32 ~/Downloads/sdfg.sql
badd +1 app/sql/seed/like.sql
badd +1 app/assets/css/account.css
badd +1 app/html/setup/setup.html
badd +1 app/controllers/message.php
badd +10 app/views/message.php
badd +1 ~/cursus/matcha
badd +1 app/models/message.php
badd +27 app/models/matches.php
badd +2 app/models/profil.php
badd +3 app/models/user.php
badd +1 app/html/messages.html
badd +1 app/html/message.html
badd +9 app/assets/css/message.css
badd +15 app/controllers/matches.php
badd +1 ~/vim
badd +0 app/html/conversation.html
badd +0 app/js
badd +0 app/js/chat.js
argglobal
silent! argdel *
tabnew
tabnew
tabnew
tabnew
tabnew
tabnew
tabnext -6
edit config/database.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
3wincmd h
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 8 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 28 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 5resize ' . ((&columns * 95 + 181) / 362)
exe '6resize ' . ((&lines * 41 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 96 + 181) / 362)
exe '7resize ' . ((&lines * 35 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 96 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 6 - ((5 * winheight(0) + 4) / 8)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
6
normal! 022|
wincmd w
argglobal
if bufexists('config/config.php') | buffer config/config.php | else | edit config/config.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 31 - ((30 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
31
normal! 0
wincmd w
argglobal
if bufexists('app/entity/user.php') | buffer app/entity/user.php | else | edit app/entity/user.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 17 - ((14 * winheight(0) + 14) / 28)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
17
normal! 0
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/index.php') | buffer ~/cursus/matcha/index.php | else | edit ~/cursus/matcha/index.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
8
normal! zo
let s:l = 1 - ((0 * winheight(0) + 38) / 77)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/core.php') | buffer ~/cursus/matcha/core/core.php | else | edit ~/cursus/matcha/core/core.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
27
normal! zo
32
normal! zo
57
normal! zo
67
normal! zo
80
normal! zo
97
normal! zo
105
normal! zo
106
normal! zc
113
normal! zo
113
normal! zc
let s:l = 29 - ((20 * winheight(0) + 38) / 77)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
29
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/loader.php') | buffer ~/cursus/matcha/core/loader.php | else | edit ~/cursus/matcha/core/loader.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
17
normal! zo
72
normal! zo
let s:l = 26 - ((25 * winheight(0) + 20) / 41)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
26
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/db.php') | buffer ~/cursus/matcha/core/db.php | else | edit ~/cursus/matcha/core/db.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=5
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
9
normal! zo
let s:l = 10 - ((9 * winheight(0) + 17) / 35)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
10
normal! 09|
wincmd w
exe '1resize ' . ((&lines * 8 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 28 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 5resize ' . ((&columns * 95 + 181) / 362)
exe '6resize ' . ((&lines * 41 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 96 + 181) / 362)
exe '7resize ' . ((&lines * 35 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 96 + 181) / 362)
tabnext
edit ~/cursus/matcha/core/controller.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
2wincmd h
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe 'vert 1resize ' . ((&columns * 120 + 181) / 362)
exe '2resize ' . ((&lines * 59 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 17 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 42 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 34 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 120 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 51 - ((48 * winheight(0) + 38) / 77)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
51
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/view.php') | buffer ~/cursus/matcha/core/view.php | else | edit ~/cursus/matcha/core/view.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 52 - ((51 * winheight(0) + 29) / 59)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
52
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/modules_view.php') | buffer ~/cursus/matcha/core/modules/modules_view.php | else | edit ~/cursus/matcha/core/modules/modules_view.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 8) / 17)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/db.php') | buffer ~/cursus/matcha/core/db.php | else | edit ~/cursus/matcha/core/db.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=5
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 24 - ((23 * winheight(0) + 21) / 42)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
24
normal! 09|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/modules.php') | buffer ~/cursus/matcha/core/modules/modules.php | else | edit ~/cursus/matcha/core/modules/modules.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
13
normal! zo
20
normal! zo
let s:l = 1 - ((0 * winheight(0) + 17) / 34)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
exe 'vert 1resize ' . ((&columns * 120 + 181) / 362)
exe '2resize ' . ((&lines * 59 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 17 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 42 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 34 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 120 + 181) / 362)
tabnext
edit ~/cursus/matcha/app/controllers/home.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
4wincmd h
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
3wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe '5resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 84 + 181) / 362)
exe '6resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 84 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 84 + 181) / 362)
exe '8resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 84 + 181) / 362)
exe '9resize ' . ((&lines * 20 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 84 + 181) / 362)
exe '10resize ' . ((&lines * 17 + 40) / 81)
exe 'vert 10resize ' . ((&columns * 84 + 181) / 362)
exe '11resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 11resize ' . ((&columns * 22 + 181) / 362)
exe '12resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 12resize ' . ((&columns * 22 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 8 - ((7 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
8
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/home.php') | buffer ~/cursus/matcha/app/views/home.php | else | edit ~/cursus/matcha/app/views/home.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 2 - ((1 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
2
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/login.php') | buffer ~/cursus/matcha/app/controllers/login.php | else | edit ~/cursus/matcha/app/controllers/login.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
12
normal! zo
let s:l = 48 - ((25 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
48
normal! 012|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/login.php') | buffer ~/cursus/matcha/app/views/login.php | else | edit ~/cursus/matcha/app/views/login.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/register.php') | buffer ~/cursus/matcha/app/controllers/register.php | else | edit ~/cursus/matcha/app/controllers/register.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
12
normal! zo
let s:l = 41 - ((32 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
41
normal! 05|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/register.php') | buffer ~/cursus/matcha/app/views/register.php | else | edit ~/cursus/matcha/app/views/register.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 10 - ((6 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
10
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/setup.php') | buffer ~/cursus/matcha/app/controllers/setup.php | else | edit ~/cursus/matcha/app/controllers/setup.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
12
normal! zo
22
normal! zo
31
normal! zo
34
normal! zo
34
normal! zo
let s:l = 46 - ((17 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
46
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/models/setup.php') | buffer ~/cursus/matcha/app/models/setup.php | else | edit ~/cursus/matcha/app/models/setup.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
21
normal! zo
let s:l = 36 - ((18 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
36
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/setup.php') | buffer ~/cursus/matcha/app/views/setup.php | else | edit ~/cursus/matcha/app/views/setup.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 10) / 20)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/setup/setup.html') | buffer ~/cursus/matcha/app/html/setup/setup.html | else | edit ~/cursus/matcha/app/html/setup/setup.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 8) / 17)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/sql_test.php') | buffer ~/cursus/matcha/app/controllers/sql_test.php | else | edit ~/cursus/matcha/app/controllers/sql_test.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 6 - ((5 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
6
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/sql_test.php') | buffer ~/cursus/matcha/app/views/sql_test.php | else | edit ~/cursus/matcha/app/views/sql_test.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
exe '1resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe '5resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 84 + 181) / 362)
exe '6resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 84 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 84 + 181) / 362)
exe '8resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 84 + 181) / 362)
exe '9resize ' . ((&lines * 20 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 84 + 181) / 362)
exe '10resize ' . ((&lines * 17 + 40) / 81)
exe 'vert 10resize ' . ((&columns * 84 + 181) / 362)
exe '11resize ' . ((&lines * 39 + 40) / 81)
exe 'vert 11resize ' . ((&columns * 22 + 181) / 362)
exe '12resize ' . ((&lines * 37 + 40) / 81)
exe 'vert 12resize ' . ((&columns * 22 + 181) / 362)
tabnext
edit ~/cursus/matcha/app/html/layout/default.html
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
2wincmd h
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 40 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 91 + 181) / 362)
exe '2resize ' . ((&lines * 36 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 91 + 181) / 362)
exe '3resize ' . ((&lines * 40 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 138 + 181) / 362)
exe '4resize ' . ((&lines * 36 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 138 + 181) / 362)
exe '5resize ' . ((&lines * 30 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 131 + 181) / 362)
exe '6resize ' . ((&lines * 31 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 131 + 181) / 362)
exe '7resize ' . ((&lines * 14 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 131 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
4
normal! zo
20
normal! zo
let s:l = 41 - ((34 * winheight(0) + 20) / 40)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
41
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/header.html') | buffer ~/cursus/matcha/app/html/header.html | else | edit ~/cursus/matcha/app/html/header.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
12
normal! zo
13
normal! zo
15
normal! zo
24
normal! zo
let s:l = 20 - ((18 * winheight(0) + 18) / 36)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
20
normal! 024|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/account.html') | buffer ~/cursus/matcha/app/html/account.html | else | edit ~/cursus/matcha/app/html/account.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 37 - ((36 * winheight(0) + 20) / 40)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
37
normal! 012|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/home.html') | buffer ~/cursus/matcha/app/html/home.html | else | edit ~/cursus/matcha/app/html/home.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 14 - ((13 * winheight(0) + 18) / 36)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
14
normal! 02|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/assets/css/style.css') | buffer ~/cursus/matcha/app/assets/css/style.css | else | edit ~/cursus/matcha/app/assets/css/style.css | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
191
normal! zo
210
normal! zo
265
normal! zo
277
normal! zo
let s:l = 365 - ((27 * winheight(0) + 15) / 30)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
365
normal! 01|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/assets/css/account.css') | buffer ~/cursus/matcha/app/assets/css/account.css | else | edit ~/cursus/matcha/app/assets/css/account.css | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 16 - ((15 * winheight(0) + 15) / 31)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
16
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/prompter.html') | buffer ~/cursus/matcha/app/html/prompter.html | else | edit ~/cursus/matcha/app/html/prompter.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 7) / 14)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 03|
wincmd w
exe '1resize ' . ((&lines * 40 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 91 + 181) / 362)
exe '2resize ' . ((&lines * 36 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 91 + 181) / 362)
exe '3resize ' . ((&lines * 40 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 138 + 181) / 362)
exe '4resize ' . ((&lines * 36 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 138 + 181) / 362)
exe '5resize ' . ((&lines * 30 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 131 + 181) / 362)
exe '6resize ' . ((&lines * 31 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 131 + 181) / 362)
exe '7resize ' . ((&lines * 14 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 131 + 181) / 362)
tabnext
edit ~/cursus/matcha/core/modules/email/c_email.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
2wincmd h
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
4wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe 'vert 1resize ' . ((&columns * 120 + 181) / 362)
exe '2resize ' . ((&lines * 25 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 28 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 22 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 120 + 181) / 362)
exe '6resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 120 + 181) / 362)
exe '7resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 120 + 181) / 362)
exe '8resize ' . ((&lines * 11 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 120 + 181) / 362)
exe '9resize ' . ((&lines * 7 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 120 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
45
normal! zo
let s:l = 36 - ((34 * winheight(0) + 38) / 77)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
36
normal! 05|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/c_session.php') | buffer ~/cursus/matcha/core/modules/session/c_session.php | else | edit ~/cursus/matcha/core/modules/session/c_session.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 113 - ((13 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
113
normal! 038|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/v_session.php') | buffer ~/cursus/matcha/core/modules/session/v_session.php | else | edit ~/cursus/matcha/core/modules/session/v_session.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 10 - ((8 * winheight(0) + 14) / 28)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
10
normal! 038|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/m_session.php') | buffer ~/cursus/matcha/core/modules/session/m_session.php | else | edit ~/cursus/matcha/core/modules/session/m_session.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
79
normal! zo
let s:l = 107 - ((9 * winheight(0) + 11) / 22)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
107
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/html/loggued.html') | buffer ~/cursus/matcha/core/modules/session/html/loggued.html | else | edit ~/cursus/matcha/core/modules/session/html/loggued.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/html/login.html') | buffer ~/cursus/matcha/core/modules/session/html/login.html | else | edit ~/cursus/matcha/core/modules/session/html/login.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
2
normal! zo
3
normal! zo
let s:l = 1 - ((0 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/html/register.html') | buffer ~/cursus/matcha/core/modules/session/html/register.html | else | edit ~/cursus/matcha/core/modules/session/html/register.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
2
normal! zo
9
normal! zo
let s:l = 13 - ((11 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
13
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/html/forgot_password.html') | buffer ~/cursus/matcha/core/modules/session/html/forgot_password.html | else | edit ~/cursus/matcha/core/modules/session/html/forgot_password.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
2
normal! zo
3
normal! zo
let s:l = 1 - ((0 * winheight(0) + 5) / 11)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/session/html/change_password.html') | buffer ~/cursus/matcha/core/modules/session/html/change_password.html | else | edit ~/cursus/matcha/core/modules/session/html/change_password.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
2
normal! zo
3
normal! zo
6
normal! zo
let s:l = 6 - ((3 * winheight(0) + 3) / 7)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
6
normal! 027|
wincmd w
exe 'vert 1resize ' . ((&columns * 120 + 181) / 362)
exe '2resize ' . ((&lines * 25 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 28 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 22 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 120 + 181) / 362)
exe '6resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 120 + 181) / 362)
exe '7resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 120 + 181) / 362)
exe '8resize ' . ((&lines * 11 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 120 + 181) / 362)
exe '9resize ' . ((&lines * 7 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 120 + 181) / 362)
tabnext
edit ~/cursus/matcha/app/assets/css/style.css
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
3wincmd h
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
3wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 14 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 10 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 51 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 15 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 25 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 25 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 9 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 92 + 181) / 362)
exe '8resize ' . ((&lines * 57 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 84 + 181) / 362)
exe '9resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 84 + 181) / 362)
exe '10resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 10resize ' . ((&columns * 99 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 11resize ' . ((&columns * 99 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
191
normal! zo
210
normal! zo
let s:l = 266 - ((6 * winheight(0) + 7) / 14)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
266
normal! 020|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/websocket/html/chat.html') | buffer ~/cursus/matcha/core/modules/websocket/html/chat.html | else | edit ~/cursus/matcha/core/modules/websocket/html/chat.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 3 - ((2 * winheight(0) + 5) / 10)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
3
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/js/chat.js') | buffer ~/cursus/matcha/app/js/chat.js | else | edit ~/cursus/matcha/app/js/chat.js | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
3
normal! zo
4
normal! zo
17
normal! zo
17
normal! zc
27
normal! zo
62
normal! zo
68
normal! zo
71
normal! zo
76
normal! zo
83
normal! zo
85
normal! zo
96
normal! zo
102
normal! zo
107
normal! zo
116
normal! zo
118
normal! zo
119
normal! zo
120
normal! zo
131
normal! zo
167
normal! zo
179
normal! zo
180
normal! zo
192
normal! zo
193
normal! zo
195
normal! zo
201
normal! zo
203
normal! zo
214
normal! zo
226
normal! zo
let s:l = 60 - ((5 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
60
normal! 029|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/websocket/c_websocket.php') | buffer ~/cursus/matcha/core/modules/websocket/c_websocket.php | else | edit ~/cursus/matcha/core/modules/websocket/c_websocket.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 12 - ((11 * winheight(0) + 7) / 15)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
12
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/websocket/v_websocket.php') | buffer ~/cursus/matcha/core/modules/websocket/v_websocket.php | else | edit ~/cursus/matcha/core/modules/websocket/v_websocket.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
let s:l = 13 - ((12 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
13
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/layout/default.html') | buffer ~/cursus/matcha/app/html/layout/default.html | else | edit ~/cursus/matcha/app/html/layout/default.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 41 - ((19 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
41
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/websocket/start_server.sh') | buffer ~/cursus/matcha/core/modules/websocket/start_server.sh | else | edit ~/cursus/matcha/core/modules/websocket/start_server.sh | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 2 - ((1 * winheight(0) + 4) / 9)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
2
normal! 033|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/websocket/web_socket_serveur.php') | buffer ~/cursus/matcha/core/modules/websocket/web_socket_serveur.php | else | edit ~/cursus/matcha/core/modules/websocket/web_socket_serveur.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=6
setlocal fml=1
setlocal fdn=20
setlocal fen
21
normal! zo
220
normal! zo
let s:l = 236 - ((33 * winheight(0) + 28) / 57)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
236
normal! 0
wincmd w
argglobal
terminal ++curwin ++cols=84 ++rows=19 
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 11 - ((10 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
11
normal! 023|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/db.php') | buffer ~/cursus/matcha/core/db.php | else | edit ~/cursus/matcha/core/db.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=5
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
9
normal! zo
29
normal! zo
38
normal! zo
40
normal! zo
62
normal! zo
let s:l = 46 - ((21 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
46
normal! 024|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/loader.php') | buffer ~/cursus/matcha/core/loader.php | else | edit ~/cursus/matcha/core/loader.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
72
normal! zo
let s:l = 22 - ((6 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
22
normal! 032|
wincmd w
exe '1resize ' . ((&lines * 14 + 40) / 81)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 10 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 51 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 15 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 25 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 25 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 9 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 92 + 181) / 362)
exe '8resize ' . ((&lines * 57 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 84 + 181) / 362)
exe '9resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 84 + 181) / 362)
exe '10resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 10resize ' . ((&columns * 99 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 11resize ' . ((&columns * 99 + 181) / 362)
tabnext
edit ~/cursus/matcha/app/js/chat.js
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
3wincmd h
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
3wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
3wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 92 + 181) / 362)
exe '8resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 92 + 181) / 362)
exe '9resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 92 + 181) / 362)
exe '10resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 10resize ' . ((&columns * 91 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 11resize ' . ((&columns * 91 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
3
normal! zo
4
normal! zo
17
normal! zo
17
normal! zc
27
normal! zo
62
normal! zo
68
normal! zo
71
normal! zo
76
normal! zo
83
normal! zo
85
normal! zo
96
normal! zo
102
normal! zo
107
normal! zo
116
normal! zo
118
normal! zo
119
normal! zo
120
normal! zo
131
normal! zo
167
normal! zo
179
normal! zo
180
normal! zo
192
normal! zo
193
normal! zo
195
normal! zo
201
normal! zo
203
normal! zo
214
normal! zo
226
normal! zo
let s:l = 31 - ((30 * winheight(0) + 38) / 77)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
31
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/message.php') | buffer ~/cursus/matcha/app/controllers/message.php | else | edit ~/cursus/matcha/app/controllers/message.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
16
normal! zo
29
normal! zo
31
normal! zo
33
normal! zo
let s:l = 40 - ((12 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
40
normal! 0
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/message.php') | buffer ~/cursus/matcha/app/views/message.php | else | edit ~/cursus/matcha/app/views/message.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
let s:l = 6 - ((5 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
6
normal! 05|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/models/message.php') | buffer ~/cursus/matcha/app/models/message.php | else | edit ~/cursus/matcha/app/models/message.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=5
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
24
normal! zo
40
normal! zo
41
normal! zo
63
normal! zo
64
normal! zo
64
normal! zo
85
normal! zo
86
normal! zo
let s:l = 90 - ((10 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
90
normal! 025|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/sql/tables.sql') | buffer ~/cursus/matcha/app/sql/tables.sql | else | edit ~/cursus/matcha/app/sql/tables.sql | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 50 - ((10 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
50
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/message.html') | buffer ~/cursus/matcha/app/html/message.html | else | edit ~/cursus/matcha/app/html/message.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=6
setlocal fml=1
setlocal fdn=20
setlocal fen
2
normal! zo
3
normal! zo
15
normal! zo
16
normal! zo
22
normal! zo
22
normal! zo
22
normal! zo
22
normal! zo
34
normal! zo
34
normal! zo
34
normal! zo
34
normal! zo
let s:l = 42 - ((12 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
42
normal! 05|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/conversation.html') | buffer ~/cursus/matcha/app/html/conversation.html | else | edit ~/cursus/matcha/app/html/conversation.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
6
normal! zo
17
normal! zo
23
normal! zo
23
normal! zo
23
normal! zo
30
normal! zo
30
normal! zo
34
normal! zo
34
normal! zo
let s:l = 1 - ((0 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 021|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/sql/tables.sql') | buffer ~/cursus/matcha/app/sql/tables.sql | else | edit ~/cursus/matcha/app/sql/tables.sql | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 46 - ((8 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
46
normal! 024|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/models/user.php') | buffer ~/cursus/matcha/app/models/user.php | else | edit ~/cursus/matcha/app/models/user.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
8
normal! zo
let s:l = 13 - ((10 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
13
normal! 013|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/assets/css/message.css') | buffer ~/cursus/matcha/app/assets/css/message.css | else | edit ~/cursus/matcha/app/assets/css/message.css | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 87 - ((25 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
87
normal! 0
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/assets/css/style.css') | buffer ~/cursus/matcha/app/assets/css/style.css | else | edit ~/cursus/matcha/app/assets/css/style.css | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
191
normal! zo
let s:l = 35 - ((5 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
35
normal! 0
lcd ~/cursus/matcha
wincmd w
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 7resize ' . ((&columns * 92 + 181) / 362)
exe '8resize ' . ((&lines * 19 + 40) / 81)
exe 'vert 8resize ' . ((&columns * 92 + 181) / 362)
exe '9resize ' . ((&lines * 18 + 40) / 81)
exe 'vert 9resize ' . ((&columns * 92 + 181) / 362)
exe '10resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 10resize ' . ((&columns * 91 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 81)
exe 'vert 11resize ' . ((&columns * 91 + 181) / 362)
tabnext 7
if exists('s:wipebuf') && len(win_findbuf(s:wipebuf)) == 0
  silent exe 'bwipe ' . s:wipebuf
endif
unlet! s:wipebuf
set winheight=5 winwidth=84 shortmess=filnxtToO
set winminheight=1 winminwidth=10
let s:sx = expand("<sfile>:p:r")."x.vim"
if file_readable(s:sx)
  exe "source " . fnameescape(s:sx)
endif
let &so = s:so_save | let &siso = s:siso_save
doautoall SessionLoadPost
unlet SessionLoad
" vim: set ft=vim :
