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
badd +22 core/loader.php
badd +1 core/controller.php
badd +42 core/view.php
badd +1 app/entity/user.php
badd +1 config/database.php
badd +1 app/controllers/home.php
badd +4 app/html/home.html
badd +66 core/core.php
badd +1 core/modules.php
badd +38 core/db.php
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
badd +50 app/sql/tables.sql
badd +16 app/controllers/setup.php
badd +3 app/sql/seed/tag.sql
badd +7 app/models/setup.php
badd +8 core/modules/session/m_session.php
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
badd +8 app/views/setup.php
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
badd +17 app/models/user.php
badd +1 app/html/messages.html
badd +1 app/html/message.html
badd +9 app/assets/css/message.css
badd +15 app/controllers/matches.php
badd +1 ~/vim
badd +1 app/html/conversation.html
badd +1 app/js
badd +1 app/js/chat.js
badd +1 core/bdd_pdo.php
badd +15 app/controllers/profil.php
badd +1 app/views/profil.php
badd +1 app/html/profil.html
badd +1 app/models/history.php
badd +1 core/modules/notifications
badd +38 core/modules/notifications/c_notifications.php
badd +1 core/modules/notifications/m_notifications.php
badd +2 core/modules/notifications/v_notifications.php
badd +1 core/modules/notifications/html/notifications.html
badd +1 app/controllers/ajax.php
badd +1 app/models/interactions.php
badd +162 app/models/account.php
badd +1 app/js/xhr.js
badd +8 app/js/main.js
badd +0 .htaccess
badd +14 core/tool.php
badd +0 app/html/matches.html
badd +2 t
argglobal
silent! argdel *
tabnew
tabnew
tabnew
tabnew
tabnew
tabnew
tabnew
tabnew
tabnext -8
edit .htaccess
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
wincmd _ | wincmd |
split
3wincmd k
wincmd w
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
exe '1resize ' . ((&lines * 12 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 92 + 181) / 362)
exe '2resize ' . ((&lines * 12 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 24 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe 'vert 5resize ' . ((&columns * 88 + 181) / 362)
exe 'vert 6resize ' . ((&columns * 88 + 181) / 362)
exe '7resize ' . ((&lines * 20 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 91 + 181) / 362)
exe '8resize ' . ((&lines * 55 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 91 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 5 - ((4 * winheight(0) + 6) / 12)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
5
normal! 044|
wincmd w
argglobal
if bufexists('config/database.php') | buffer config/database.php | else | edit config/database.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 5 - ((4 * winheight(0) + 6) / 12)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
5
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
let s:l = 17 - ((16 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
17
normal! 029|
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
let s:l = 17 - ((12 * winheight(0) + 12) / 24)
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
let s:l = 5 - ((4 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
5
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
30
normal! zo
55
normal! zo
65
normal! zo
78
normal! zo
95
normal! zo
106
normal! zo
106
normal! zo
106
normal! zc
111
normal! zo
111
normal! zc
let s:l = 12 - ((11 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
12
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
let s:l = 124 - ((14 * winheight(0) + 10) / 20)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
124
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
let s:l = 64 - ((25 * winheight(0) + 27) / 55)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
64
normal! 09|
wincmd w
exe '1resize ' . ((&lines * 12 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 92 + 181) / 362)
exe '2resize ' . ((&lines * 12 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 24 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe 'vert 5resize ' . ((&columns * 88 + 181) / 362)
exe 'vert 6resize ' . ((&columns * 88 + 181) / 362)
exe '7resize ' . ((&lines * 20 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 91 + 181) / 362)
exe '8resize ' . ((&lines * 55 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 91 + 181) / 362)
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
exe '2resize ' . ((&lines * 58 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 41 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 34 + 40) / 80)
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
let s:l = 24 - ((20 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
24
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
let s:l = 61 - ((49 * winheight(0) + 29) / 58)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
61
normal! 09|
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
let s:l = 24 - ((22 * winheight(0) + 20) / 41)
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
let s:l = 5 - ((4 * winheight(0) + 17) / 34)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
5
normal! 0
wincmd w
exe 'vert 1resize ' . ((&columns * 120 + 181) / 362)
exe '2resize ' . ((&lines * 58 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 41 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 34 + 40) / 80)
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
exe '1resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe '5resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 84 + 181) / 362)
exe '6resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 84 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 84 + 181) / 362)
exe '8resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 84 + 181) / 362)
exe '9resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 9resize ' . ((&columns * 84 + 181) / 362)
exe '10resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 10resize ' . ((&columns * 84 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 11resize ' . ((&columns * 22 + 181) / 362)
exe '12resize ' . ((&lines * 37 + 40) / 80)
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
let s:l = 8 - ((7 * winheight(0) + 19) / 38)
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
let s:l = 1 - ((0 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
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
let s:l = 1 - ((0 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
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
21
normal! zo
30
normal! zo
let s:l = 45 - ((16 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
45
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
let s:l = 1 - ((0 * winheight(0) + 9) / 19)
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
let s:l = 6 - ((5 * winheight(0) + 19) / 38)
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
exe '1resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe '5resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 84 + 181) / 362)
exe '6resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 84 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 84 + 181) / 362)
exe '8resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 84 + 181) / 362)
exe '9resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 9resize ' . ((&columns * 84 + 181) / 362)
exe '10resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 10resize ' . ((&columns * 84 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 11resize ' . ((&columns * 22 + 181) / 362)
exe '12resize ' . ((&lines * 37 + 40) / 80)
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
exe '1resize ' . ((&lines * 39 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 91 + 181) / 362)
exe '2resize ' . ((&lines * 36 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 91 + 181) / 362)
exe '3resize ' . ((&lines * 39 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 138 + 181) / 362)
exe '4resize ' . ((&lines * 36 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 138 + 181) / 362)
exe '5resize ' . ((&lines * 30 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 131 + 181) / 362)
exe '6resize ' . ((&lines * 30 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 131 + 181) / 362)
exe '7resize ' . ((&lines * 14 + 40) / 80)
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
25
normal! zo
let s:l = 15 - ((14 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
15
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
let s:l = 3 - ((2 * winheight(0) + 18) / 36)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
3
normal! 05|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/account.html') | buffer ~/cursus/matcha/app/html/account.html | else | edit ~/cursus/matcha/app/html/account.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 69 - ((61 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
69
normal! 0
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
190
normal! zo
let s:l = 365 - ((29 * winheight(0) + 15) / 30)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
365
normal! 0
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
let s:l = 16 - ((15 * winheight(0) + 15) / 30)
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
exe '1resize ' . ((&lines * 39 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 91 + 181) / 362)
exe '2resize ' . ((&lines * 36 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 91 + 181) / 362)
exe '3resize ' . ((&lines * 39 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 138 + 181) / 362)
exe '4resize ' . ((&lines * 36 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 138 + 181) / 362)
exe '5resize ' . ((&lines * 30 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 131 + 181) / 362)
exe '6resize ' . ((&lines * 30 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 131 + 181) / 362)
exe '7resize ' . ((&lines * 14 + 40) / 80)
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
exe '2resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 27 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 22 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 120 + 181) / 362)
exe '6resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 120 + 181) / 362)
exe '7resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 120 + 181) / 362)
exe '8resize ' . ((&lines * 10 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 120 + 181) / 362)
exe '9resize ' . ((&lines * 7 + 40) / 80)
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
let s:l = 3 - ((2 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
3
normal! 0
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
let s:l = 10 - ((8 * winheight(0) + 13) / 27)
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
76
normal! zo
96
normal! zo
112
normal! zo
125
normal! zo
140
normal! zo
156
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
let s:l = 1 - ((0 * winheight(0) + 5) / 10)
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
exe '2resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 120 + 181) / 362)
exe '3resize ' . ((&lines * 27 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 120 + 181) / 362)
exe '4resize ' . ((&lines * 22 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 120 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 120 + 181) / 362)
exe '6resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 120 + 181) / 362)
exe '7resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 120 + 181) / 362)
exe '8resize ' . ((&lines * 10 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 120 + 181) / 362)
exe '9resize ' . ((&lines * 7 + 40) / 80)
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
exe '1resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 9 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 40 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 92 + 181) / 362)
exe '8resize ' . ((&lines * 59 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 92 + 181) / 362)
exe '9resize ' . ((&lines * 16 + 40) / 80)
exe 'vert 9resize ' . ((&columns * 92 + 181) / 362)
exe '10resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 10resize ' . ((&columns * 91 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 11resize ' . ((&columns * 91 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
190
normal! zo
let s:l = 3 - ((2 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
3
normal! 0
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
let s:l = 1 - ((0 * winheight(0) + 4) / 9)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
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
11
normal! zo
13
normal! zo
22
normal! zo
11
normal! zc
65
normal! zo
72
normal! zo
73
normal! zo
76
normal! zo
81
normal! zo
89
normal! zo
99
normal! zo
109
normal! zo
118
normal! zo
125
normal! zo
128
normal! zo
134
normal! zo
137
normal! zo
143
normal! zo
145
normal! zo
148
normal! zo
160
normal! zo
173
normal! zo
185
normal! zo
188
normal! zo
188
normal! zc
185
normal! zc
214
normal! zo
216
normal! zo
218
normal! zo
224
normal! zo
236
normal! zo
252
normal! zo
259
normal! zo
267
normal! zo
275
normal! zo
288
normal! zo
340
normal! zo
347
normal! zo
354
normal! zo
366
normal! zo
380
normal! zo
396
normal! zo
421
normal! zo
430
normal! zo
445
normal! zo
457
normal! zo
let s:l = 64 - ((63 * winheight(0) + 20) / 40)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
64
normal! 0
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
let s:l = 9 - ((8 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
9
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
let s:l = 5 - ((4 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
5
normal! 038|
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
let s:l = 35 - ((12 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
35
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
let s:l = 2 - ((1 * winheight(0) + 9) / 18)
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
22
normal! zo
60
normal! zo
22
normal! zc
141
normal! zo
156
normal! zo
181
normal! zo
195
normal! zo
195
normal! zo
203
normal! zo
let s:l = 273 - ((44 * winheight(0) + 29) / 59)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
273
normal! 0
wincmd w
argglobal
terminal ++curwin ++cols=92 ++rows=16 
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 8) / 16)
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
let s:l = 111 - ((36 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
111
normal! 0
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
85
normal! zo
86
normal! zo
let s:l = 1 - ((0 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
exe '1resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 9 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 40 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe '4resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 92 + 181) / 362)
exe '8resize ' . ((&lines * 59 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 92 + 181) / 362)
exe '9resize ' . ((&lines * 16 + 40) / 80)
exe 'vert 9resize ' . ((&columns * 92 + 181) / 362)
exe '10resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 10resize ' . ((&columns * 91 + 181) / 362)
exe '11resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 11resize ' . ((&columns * 91 + 181) / 362)
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
2wincmd k
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
exe 'vert 1resize ' . ((&columns * 92 + 181) / 362)
exe '2resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 84 + 181) / 362)
exe '6resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 84 + 181) / 362)
exe '7resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 91 + 181) / 362)
exe '8resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 91 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
11
normal! zo
13
normal! zo
13
normal! zc
11
normal! zc
let s:l = 3 - ((2 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
3
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
27
normal! zo
29
normal! zo
let s:l = 36 - ((13 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
36
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
let s:l = 10 - ((9 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
10
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
106
normal! zo
107
normal! zo
let s:l = 1 - ((0 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 05|
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
7
normal! zo
11
normal! zo
14
normal! zo
14
normal! zo
14
normal! zo
18
normal! zo
18
normal! zo
18
normal! zo
18
normal! zo
20
normal! zo
30
normal! zo
30
normal! zo
30
normal! zo
30
normal! zo
let s:l = 31 - ((23 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
31
normal! 0
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
18
normal! zo
28
normal! zo
28
normal! zo
let s:l = 12 - ((11 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
12
normal! 046|
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
190
normal! zo
let s:l = 52 - ((21 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
52
normal! 018|
lcd ~/cursus/matcha
wincmd w
exe 'vert 1resize ' . ((&columns * 92 + 181) / 362)
exe '2resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 18 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 84 + 181) / 362)
exe '6resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 84 + 181) / 362)
exe '7resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 91 + 181) / 362)
exe '8resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 91 + 181) / 362)
tabnext
edit ~/cursus/matcha/app/controllers/profil.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
2wincmd h
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 27 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 15 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 32 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 5resize ' . ((&columns * 192 + 181) / 362)
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
7
normal! zo
10
normal! zo
14
normal! zo
16
normal! zo
let s:l = 18 - ((17 * winheight(0) + 13) / 27)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
18
let s:c = 17 - ((4 * winwidth(0) + 42) / 84)
if s:c > 0
  exe 'normal! ' . s:c . '|zs' . 17 . '|'
else
  normal! 017|
endif
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/profil.php') | buffer ~/cursus/matcha/app/views/profil.php | else | edit ~/cursus/matcha/app/views/profil.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 7) / 15)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/profil.html') | buffer ~/cursus/matcha/app/html/profil.html | else | edit ~/cursus/matcha/app/html/profil.html | endif
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
2
normal! zo
2
normal! zo
2
normal! zo
9
normal! zo
10
normal! zo
10
normal! zo
10
normal! zo
86
normal! zo
100
normal! zo
let s:l = 1 - ((0 * winheight(0) + 16) / 32)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/models/history.php') | buffer ~/cursus/matcha/app/models/history.php | else | edit ~/cursus/matcha/app/models/history.php | endif
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
let s:l = 13 - ((12 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
13
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/models/profil.php') | buffer ~/cursus/matcha/app/models/profil.php | else | edit ~/cursus/matcha/app/models/profil.php | endif
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
let s:l = 1 - ((0 * winheight(0) + 38) / 76)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
exe '1resize ' . ((&lines * 27 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 84 + 181) / 362)
exe '2resize ' . ((&lines * 15 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 84 + 181) / 362)
exe '3resize ' . ((&lines * 32 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 4resize ' . ((&columns * 84 + 181) / 362)
exe 'vert 5resize ' . ((&columns * 192 + 181) / 362)
tabnext
edit ~/cursus/matcha/core/modules/notifications/c_notifications.php
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
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 92 + 181) / 362)
exe '2resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 24 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 15 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 34 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 20 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 91 + 181) / 362)
exe '8resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 91 + 181) / 362)
exe '9resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 9resize ' . ((&columns * 91 + 181) / 362)
exe '10resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 10resize ' . ((&columns * 91 + 181) / 362)
exe '11resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 11resize ' . ((&columns * 84 + 181) / 362)
exe '12resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 12resize ' . ((&columns * 84 + 181) / 362)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
16
normal! zo
25
normal! zo
let s:l = 34 - ((12 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
34
normal! 011|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/notifications/v_notifications.php') | buffer ~/cursus/matcha/core/modules/notifications/v_notifications.php | else | edit ~/cursus/matcha/core/modules/notifications/v_notifications.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 9 - ((8 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
9
normal! 0
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/notifications/m_notifications.php') | buffer ~/cursus/matcha/core/modules/notifications/m_notifications.php | else | edit ~/cursus/matcha/core/modules/notifications/m_notifications.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=20
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 7 - ((6 * winheight(0) + 12) / 24)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
7
normal! 016|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/js/xhr.js') | buffer ~/cursus/matcha/app/js/xhr.js | else | edit ~/cursus/matcha/app/js/xhr.js | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
3
normal! zo
6
normal! zo
7
normal! zo
let s:l = 8 - ((7 * winheight(0) + 7) / 15)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
8
normal! 046|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/notifications/html/notifications.html') | buffer ~/cursus/matcha/core/modules/notifications/html/notifications.html | else | edit ~/cursus/matcha/core/modules/notifications/html/notifications.html | endif
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
17
normal! zo
19
normal! zo
20
normal! zo
let s:l = 9 - ((8 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
9
normal! 05|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/js/chat.js') | buffer ~/cursus/matcha/app/js/chat.js | else | edit ~/cursus/matcha/app/js/chat.js | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=7
setlocal fml=1
setlocal fdn=20
setlocal fen
11
normal! zo
13
normal! zo
22
normal! zo
40
normal! zo
65
normal! zo
72
normal! zo
76
normal! zo
118
normal! zo
125
normal! zo
134
normal! zo
143
normal! zo
160
normal! zo
173
normal! zo
185
normal! zo
188
normal! zo
193
normal! zo
194
normal! zo
236
normal! zo
252
normal! zo
288
normal! zo
354
normal! zo
396
normal! zo
457
normal! zo
let s:l = 81 - ((20 * winheight(0) + 17) / 34)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
81
normal! 040|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/ajax.php') | buffer ~/cursus/matcha/app/controllers/ajax.php | else | edit ~/cursus/matcha/app/controllers/ajax.php | endif
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
21
normal! zo
let s:l = 11 - ((8 * winheight(0) + 10) / 20)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
11
normal! 09|
lcd ~/cursus/matcha
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
5
normal! zo
let s:l = 43 - ((10 * winheight(0) + 8) / 17)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
43
normal! 0
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/matches.html') | buffer ~/cursus/matcha/app/html/matches.html | else | edit ~/cursus/matcha/app/html/matches.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=7
setlocal fml=1
setlocal fdn=20
setlocal fen
2
normal! zo
6
normal! zo
7
normal! zo
114
normal! zo
117
normal! zo
144
normal! zo
144
normal! zo
let s:l = 163 - ((11 * winheight(0) + 8) / 17)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
163
normal! 019|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/models/interactions.php') | buffer ~/cursus/matcha/app/models/interactions.php | else | edit ~/cursus/matcha/app/models/interactions.php | endif
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
31
normal! zo
let s:l = 14 - ((13 * winheight(0) + 9) / 19)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
14
normal! 013|
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules/websocket/web_socket_serveur.php') | buffer ~/cursus/matcha/core/modules/websocket/web_socket_serveur.php | else | edit ~/cursus/matcha/core/modules/websocket/web_socket_serveur.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
22
normal! zo
60
normal! zo
61
normal! zo
111
normal! zo
141
normal! zo
143
normal! zo
156
normal! zo
181
normal! zo
195
normal! zo
195
normal! zo
203
normal! zo
218
normal! zo
222
normal! zo
242
normal! zo
259
normal! zo
267
normal! zo
278
normal! zo
291
normal! zo
306
normal! zo
309
normal! zo
345
normal! zo
355
normal! zo
361
normal! zo
365
normal! zo
let s:l = 285 - ((31 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
285
normal! 09|
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
390
normal! zo
438
normal! zo
let s:l = 440 - ((35 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
440
normal! 031|
lcd ~/cursus/matcha
wincmd w
exe '1resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 1resize ' . ((&columns * 92 + 181) / 362)
exe '2resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 2resize ' . ((&columns * 92 + 181) / 362)
exe '3resize ' . ((&lines * 24 + 40) / 80)
exe 'vert 3resize ' . ((&columns * 92 + 181) / 362)
exe '4resize ' . ((&lines * 15 + 40) / 80)
exe 'vert 4resize ' . ((&columns * 92 + 181) / 362)
exe '5resize ' . ((&lines * 25 + 40) / 80)
exe 'vert 5resize ' . ((&columns * 92 + 181) / 362)
exe '6resize ' . ((&lines * 34 + 40) / 80)
exe 'vert 6resize ' . ((&columns * 92 + 181) / 362)
exe '7resize ' . ((&lines * 20 + 40) / 80)
exe 'vert 7resize ' . ((&columns * 91 + 181) / 362)
exe '8resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 8resize ' . ((&columns * 91 + 181) / 362)
exe '9resize ' . ((&lines * 17 + 40) / 80)
exe 'vert 9resize ' . ((&columns * 91 + 181) / 362)
exe '10resize ' . ((&lines * 19 + 40) / 80)
exe 'vert 10resize ' . ((&columns * 91 + 181) / 362)
exe '11resize ' . ((&lines * 37 + 40) / 80)
exe 'vert 11resize ' . ((&columns * 84 + 181) / 362)
exe '12resize ' . ((&lines * 38 + 40) / 80)
exe 'vert 12resize ' . ((&columns * 84 + 181) / 362)
tabnext 9
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
