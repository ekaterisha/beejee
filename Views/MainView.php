<?php 
$page = '<html>';
$page .= '<head><meta charset="utf-8">
<title> ООО Рина </title>
<link rel="stylesheet" href="CSS/main.css">
</head>
<body>   
<h1>Task book</h1>

<p>Добавить задачу может каждый, редактировать её - лишь администратор</p>
<form>
  <button class="button btn-danger">Сортировка</button>
  <button class="button btn-success">Вход</button><Br>
</form>';
foreach ($model->Data as $key=>$value) {
  $checked = $value['status'] == 'done' ? 'checked' : '';
    $page .= '<section> <div>
              <span class="span sectionText"> <p>Task</p></span> <span class="span sectionCkbx">Выполнена <input type="checkbox" name="status" '.$checked.'></span>
                        </div>';
    $page .= '<div><span class="container">'.$value['fio'].'</span><br>';
    $page .= '<span class="container">'.$value['email'].'</span><br>';
    $page .= '<span class="text">'.$value['task_text'].'</span><br>';
    $page .= '
    <div>
    <button class="open-button" onclick="openForm('.$value['id'].')">Редачить</button>
    <div class="form-popup" id="myForm'.$value['id'].'">
    <form action="./handler.php?action=update&id='.$value['id'].'&now_page='.$this->now_page.'" class="form-container" method="post">
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
    <form action="../handler.php?action=delete&id='.$value['id'].'&now_page='.$this->now_page.'" method="post">
      <input type="submit" value="Удалить">
    </form></div>
   </section>';
}


$page .= '<p>Навигация</p>
<section class="pagination">';
if ($this->now_page>1){
  $page .='<a class="pagination a" href="../index.php?page='.($this->now_page-1).'">❮</a>';
}

for ($i = 1; $i <= $this->last_page; $i++) {
  $page .= '<a class="pagination a" href="../index.php?page='.$i.'" >'.$i.'</a>';
}
if ($this->now_page<$this->last_page){
  $page .='<a class="pagination a" href="../index.php?page='.($this->now_page+1).'">❯</a>';
}

$page .= '
</section>
<div><form action="../handler.php?action=insert" method="post">
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
$page .= '</body>
<footer> <div class="contacts"> ООО Рина </div>
<div class="contacts"> E-mail: ekaterisha48@gmail.com </div> </footer>
<script src="../func.js"></script>
</html>';
echo $page;

?>