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
    <button class="button btn-success"> <h4>Войти </h4></button>
    <img src="rin/Media/user.png" ><br>
  </span>
</div>
<div>
  <h1>ЗОЛОТАЯ РЫБКА</h1>

  <h4>Идеальный инструмент для тех, кому необходимо запомнить 3 задачи за раз </h4>
  </div>
</div>
<div class="tasks">
<h2>АКТУАЛЬНЫЕ ЗАДАЧИ</h2>
<p>Сортировка </p>
';
foreach ($this->model->Data as $key=>$value) {
  $checked = $value['status'] == 'done' ? 'checked' : '';
    $page .= '<section> <div>
              <span class="span sectionText"> <p>Task</p></span> <span class="span sectionCkbx">Выполнена <input type="checkbox" name="status'.$value['id'].'" '.$checked.' onclick="taskStatus('.$value['id'].')"></span>
                        </div>';
    $page .= '<div><span class="container">'.$value['fio'].'</span><br>';
    $page .= '<span class="container">'.$value['email'].'</span><br>';
    $page .= '<span class="text">'.$value['task_text'].'</span><br>';
    $page .= '
    <div>
    <button class="open-button" onclick="openForm('.$value['id'].')">Редачить</button>
    <div class="form-popup" id="myForm'.$value['id'].'">
    <form action="index.php?action=update&id='.$value['id'].'&now_page='.$this->now_page.'" class="form-container" method="post">
      <h1>Отредактировать задачу</h1>
      <label for="fio"><b>Имя</b></label><br>
      <input type="text" placeholder="Ваше имя" name="fio" value="'.$value['fio'].'" required><br>
      <label for="email"><b>Е-мейл</b></label><br>
      <input type="text" placeholder="Ваш е-мейл" name="email" value="'.$value['email'].'" required><br>
      <label for="task_text"><b>Описание задачи</b></label><br>
      <textarea placeholder="Описание задачи" rows="5" cols="42" name="task_text" required>'.$value['task_text'].'</textarea><br>
      <button type="submit" class="btn">Принять</button>
      <button type="button" class="btn cancel" onclick="closeForm('.$value['id'].')">Закрыть</button>
    </form>
  </div>
    <form action="index.php?action=delete&id='.$value['id'].'&now_page='.$this->now_page.'" method="post">
      <input type="submit" value="Удалить">
    </form></div>
   </section>';
}


$page .= '<p>Навигация</p>
<section class="pagination">';
if ($this->now_page>1){
  $page .='<a class="pagination a" href="index.php?page='.($this->now_page-1).'">❮</a>';
}

for ($i = 1; $i <= $this->last_page; $i++) {
  $page .= '<a class="pagination a" href="index.php?page='.$i.'" >'.$i.'</a>';
}
if ($this->now_page<$this->last_page){
  $page .='<a class="pagination a" href="index.php?page='.($this->now_page+1).'">❯</a>';
}

$page .= '
</section>
</div>
<div class="addtaskform">
<form id="task_form" action="index.php?action=create" method="post">
<p>Добавить задачу в список<Br>
<p><b>Ваше имя:</b><br>
<input type="text" name="fio" placeholder="Александров Александр Александрович" size="40" required></p>
<p><b>Электронная почта:</b><Br>
<input type="email" name="email" placeholder="exemple@gmail.com" size="40" required><Br>
</p>
<p><b>Описание задачи:</b><Br>
<textarea placeholder="Опишите максимально детально задачу" rows="5" cols="42" name="task_text" required></textarea><Br>
</p>
<p><b>Статус</b><br>
<p class="string"><b>Выполнена</b>
<input type="checkbox" name="status" value="done" >
</p>

<p><input type="submit" value="Добавить">
<input type="reset" value="Очистить"></p>


</form></div>';
$page .= '
<div class="contacts"> 
  <p> OОО Рина </p>
  <p> E-mail: ekaterisha48@gmail.com </p>
</div> 
</body>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="rin/JS/func.js"></script>
</html>';
echo $page;

?>