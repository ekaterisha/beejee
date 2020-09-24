<?php 
$page = '
<html>
  <head>
    <meta charset="utf-8">
    <title> ООО Рина </title>
    <link rel="stylesheet" href="rin/CSS/main.css">
  </head>
  <body>
    <div class="container-narrow">
      <div class="mainhead">
        <div class="string">
          <span class="left">
            <h4>Задачник</h4>
          </span>
          <span class="right">';
            if (!$show) {
            $page .='
              <button class="button btn-login" onclick="openAuth()"> <h4>Войти </h4></button>';
            }else{
            $page .= '
              <form action="index.php?r=Auth&action=logout&callback='.$this->getCallback().'" method="post" style="display: inline;">
                <button type="submit" class="button btn-logout" > <h4>Выйти </h4></button>
              </form>';
            }
            $page .= '
              <img src="rin/Media/user.png"><br>
              <div class="auth-popup" id="authForm">
                <form id="auth" action="index.php?r=Auth&action=create&callback='.$this->getCallback().'" class="form-container" method="post" validated="false">
                  <div class="addtaskform">  
                    <h2>ВХОД ДЛЯ АДМИНИСТРАТОРА</h2>
                  </div>
                  <div class="addtaskform">
                    <label for="login"><h4>Логин</h4></label><br>
                    <input class="input" type="text" placeholder="Введите логин" name="login" required><br>
                    <label for="password"><h4>Пароль</h4></label><br>
                    <input class="input" type="password" placeholder="Введите пароль" name="password" required><br>
                    <div id="notice">
                      <a></a>
                      <br>
                    </div><br>
                  </div>
                  <div class="authform-btn">
                    <button type="submit" class="add-button">Войти</button>
                    <button type="button" class="reset-button" onclick="closeAuth()">Закрыть</button>
                  </div>
                </form>
              </div>
          </span>
        </div>
        <div>
          <h1>ЗОЛОТАЯ РЫБКА</h1>
          <h4>Идеальный инструмент для тех, кому необходимо запомнить 3 задачи за раз </h4>
        </div>
      </div>
      <div class="tasks">
        <div>
          <h2>АКТУАЛЬНЫЕ ЗАДАЧИ</h2>
          <img src="rin/Media/sort.svg">
          <form id="sorting" action="index.php?r=Main&action=read" class="dropdown" method="post">
            <select name="sort" onchange="this.form.submit()" class="dropbtn">';
                foreach ($options as $key => $value){
            $page .= '
              <option value="'.$key.'" '.(($concat == $key) ? 'selected' : '' ).'>'.$value.'</option>';
                }
            $page .= '
            </select>
          </form>
        </div>';
        foreach ($data_provider as $key=>$value) {
        $checked = $value['status'] == 'done' ? 'checked' : '';
        $page .= '
        <section> 
          <div> 
            <div>
                <span class="span sectionText">'.$value['fio'].'</span>
                <span class="span sectionCkbx">
                '.(($value['edited_by_admin'] == "1") ? '<img src="rin/Media/edit.svg" title="Отредактировано администратором">' : '').'
                <input class="input-ckbx" type="checkbox" name="status'.$value['id'].'" '.$checked.'
                        onclick="taskStatus('.$value['id'].')" '.(!$show?"disabled":"").'>
                </span>
            </div>
              <span class="container">'.$value['email'].'</span> 
          </div>
          <div class="text">'.$value['task_text'].'
          </div>';
            if ($show) {
            $page .= '
          <div>
            <button class="open-button" onclick="openForm('.$value['id'].')">Редактировать</button>
            <div class="form-popup" id="myForm'.$value['id'].'">
              <form action="index.php?action=update&id='.$value['id'].'" class="form-container" method="post">
                <div class="addtaskform">
                  <h2>РЕДАКТИРОВАНИЕ ЗАДАЧИ</h2>
                </div>
                <div class="addtaskform">
                  <span class="left-add">
                    <label for="fio"><h4>Имя</h4></label><br>
                    <input class="input" type="text" placeholder="Ваше имя" name="fio" value="'.$value['fio'].'" required><br>
                  </span>
                  <span class="right-add">
                    <label for="email"><h4>Е-мейл</h4></label><br>
                    <input class="input" type="text" placeholder="Ваш е-мейл" name="email" value="'.$value['email'].'" required><br>
                  </span>
                </div>
                <div class="addtaskform">
                <span class="left-add">
                  <label for="task_text"><h4>Описание задачи</h4></label><br>
                  <textarea class="input-desc" placeholder="Описание задачи" rows="5" cols="42" name="task_text" required>'.$value['task_text'].'</textarea><br>
                </span>
                </div>
                <div class="addtaskform-btn">
                <button type="submit" class="add-button">Принять</button>
                <button type="button" class="reset-button" onclick="closeForm('.$value['id'].')">Закрыть</button>
                </div>
              </form>
            </div>
            <form action="index.php?action=delete&id='.$value['id'].'" method="post">
              <input type="submit"  class="delete-button" value="Удалить">
            </form>
          </div>';
            }
          $page .= '
        </section>';
          }
        $page .= '
        <br>
        <div class="pagination">';
          if ($this->now_page>1){
            $page .='<a class="pagination a" href="index.php?page='.($this->now_page-1).'">Назад</a>';
          }
          for ($i = 1; $i <= $this->last_page; $i++) {
            $page .= '<a class="pagination a" href="index.php?page='.$i.'" >'.$i.'</a>';
          }
          if ($this->now_page<$this->last_page){
            $page .='<a class="pagination a" href="index.php?page='.($this->now_page+1).'">Дальше</a>';
          }
          $page .= '
        </div>
      </div>
      <div>
        <form id="task_form" action="index.php?action=create" method="post">
          <div class="addtaskform">
            <h2>ДОБАВИТЬ НОВУЮ ЗАДАЧУ</h2>
          </div>
          <div class="addtaskform">
            <span class="left-add"><h4>Имя</h4><br>
            <input type="text" class="input" name="fio" placeholder="Александров Александр Александрович" size="40" required></span>
            <span class="right-add"><h4>E-mail</h4><Br>
            <input type="email" class="input" name="email" placeholder="exemple@gmail.com" required>
            </span>
          </div>
          <div class="addtaskform">
            <span class="left-add"><h4>Описание задачи<h4><Br>
            <textarea class="input-desc" placeholder="Опишите максимально детально задачу"  rows="5" cols="42" name="task_text" required></textarea><Br>
            </span>
          </div>
          <div class="addtaskform" style="height: 65px;">
            <div class="addtaskform-btn">
              <input class="reset-button" type="reset" value="Очистить">
              <input class="add-button" type="submit" value="Добавить">
            </div>
          </div>
        </form>
      </div>';
        $page .= '
        <div> 
          <p class="contacts"> Градковская Рина </p>
          <p class="contacts"> E-mail: <a href="mailto:ekaterisha48@gmail.com?subject=Вопрос по Задачнику"> ekaterisha48@gmail.com </a> </p>
        </div>
    </div>
  </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="rin/JS/func.js"></script>
</html>';
echo $page;
?>