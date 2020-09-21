<?php 
$page = '<html>';
$page .= '<head><meta charset="utf-8">
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
  <span class="right">
    <button class="button btn-login"> <h4>Войти </h4></button>
    <img src="rin/Media/user.png" ><br>
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
  <h4>Сортировка </h4>
  <div/>
';
foreach ($this->model->Data as $key=>$value) {
  $checked = $value['status'] == 'done' ? 'checked' : '';
    $page .= '<section> 
              <div> 
              <div>
              <span class="span sectionText">'.$value['fio'].'</span> 
              <span class="span sectionCkbx"> Status <input class="input-ckbx" type="checkbox" name="status'.$value['id'].'" '.$checked.' onclick="taskStatus('.$value['id'].')"></span>
               </div>';
    $page .= '<span class="container">'.$value['email'].'</span> </div>';
    $page .= '<div class="text">'.$value['task_text'].'</div>';
    $page .= '
    <div>
    <button class="open-button" onclick="openForm('.$value['id'].')">Редактировать</button>
    <div class="form-popup" id="myForm'.$value['id'].'">
    <form action="index.php?action=update&id='.$value['id'].'&now_page='.$this->now_page.'" class="form-container" method="post">
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
    <form action="index.php?action=delete&id='.$value['id'].'&now_page='.$this->now_page.'" method="post">
      <input type="submit"  class="delete-button" value="Удалить">
    </form></div>
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
</body>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="rin/JS/func.js"></script>
</html>';
echo $page;

?>