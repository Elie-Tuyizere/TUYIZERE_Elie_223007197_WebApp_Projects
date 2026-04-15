<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Registration Form</title>

<style>
body {
    font-family: "Times New Roman", Times, serif;
    background: #fff;
    margin: 0;
    padding: 20px;
}

.form-container {
    width: 800px;
    margin: auto;
}

h1 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

/* FORM */ 
.form-row {
    display: flex;
    align-items: center;
    margin: 8px 0;
}

.form-row label:first-child {
    width: 140px;
    font-size: 14px;
}

/* INPUTS */
input[type="text"],
input[type="email"],
input[type="tel"],
textarea {
    border: 1px solid #000;
    padding: 4px 6px;
    font-family: "Times New Roman";
}

.small-input { width: 200px; }
.medium-input { width: 260px; }

textarea {
    height: 50px;
    width: 260px;
}

select {
    border: 1px solid #000;
    padding: 4px;
    margin-right: 8px;
}

.inline {
    margin-right: 15px;
}

/* HOBBIES */
.hobbies-row {
    display: flex;
    align-items: center;
    margin: 8px 0;
}

.hobbies-row label:first-child {
    width: 140px;
}

.hobbies-line {
    margin-left: 140px;
    margin-top: 5px;
}

/* ✅ QUALIFICATION HEADER + TABLE INLINE */
.qualification-section {
    display: flex;
    align-items: flex-start;
    margin-top: 15px;
}

.qualification-title {
    width: 140px;
    font-size: 16px;
    font-weight: bold;
    padding-top: 8px;
}

/* TABLE */
table { 
    margin-top: 10px;
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 5px;
    text-align: left;
}

table input {
    width: 170px;
    border: 1px solid #000;
    height: 22px;
}
/* NOTES OUTSIDE TABLE */
.table-notes {
    display: grid;
    grid-template-columns: 8% 22% 25% 22% 23%;
    width: calc(100% - 140px);
    margin-left: 140px;
    margin-top: 5px;
}

.table-notes div {
    font-size: 12px;
    font-style: italic;
}

/* BUTTONS */
.buttons {
    text-align: center;
    margin-top: 20px;
}

button {
    padding: 5px 25px;
    margin: 0 10px;
    border: 1px solid #000;
    background: #fff;
    cursor: pointer;
}

button:hover {
    background: #f0f0f0;
}

/* FOOTER WITH UNDERLINE */
.footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 10px;
}

.footer hr {
    border: 1px solid #000;
}
</style>

</head>
<body>

<div class="form-container">
<h1>STUDENT REGISTRATION FORM</h1>

<form action="submit.php" method="POST">

<div class="form-row">
<label>FIRST NAME</label>
<input type="text" name="first_name" class="small-input" required>
</div>

<div class="form-row">
<label>LAST NAME</label>
<input type="text" name="last_name" class="small-input" required>
</div>

<div class="form-row">
<label>DATE OF BIRTH</label>
<select name="day" required>
<option value="">Day</option>
<?php 
for($d=1; $d<=31; $d++) {
    echo "<option value='$d'>$d</option>";
}
?>
</select>
<select name="month" required>
<option value="">Month</option>
<?php 
$months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
for($m=1; $m<=12; $m++) {
    echo "<option value='$m'>".$months[$m-1]."</option>";
}
?>
</select>
<select name="year" required>
<option value="">Year</option>
<?php 
for($y=1990; $y<=2010; $y++) {
    echo "<option value='$y'>$y</option>";
}
?>
</select>
</div>

<div class="form-row">
<label>EMAIL ID</label>
<input type="email" name="email" class="small-input" required>
</div>

<div class="form-row">
<label>MOBILE NUMBER</label>
<input type="tel" name="mobile" class="medium-input" required>
</div>

<div class="form-row">
<label>GENDER</label>
<label class="inline"><input type="radio" name="gender" value="Male" required> Male</label>
<label class="inline"><input type="radio" name="gender" value="Female" required> Female</label>
</div>

<div class="form-row">
<label>ADDRESS</label>
<textarea name="address" required></textarea>
</div>

<div class="form-row">
<label>CITY</label>
<input type="text" name="city" class="small-input" required>
</div>

<div class="form-row">
<label>PIN CODE</label>
<input type="text" name="pincode" class="medium-input" required>
</div>

<div class="form-row">
<label>STATE</label>
<input type="text" name="state" class="small-input" required>
</div>

<div class="form-row">
<label>COUNTRY</label>
<select name="country" class="small-input" required>
<option value="India" selected>India</option>
<option value="USA">USA</option>
<option value="UK">UK</option>
<option value="Canada">Canada</option>
<option value="Australia">Australia</option>
</select>
</div>

<!-- HOBBIES -->
<div class="hobbies-row">
<label>HOBBIES</label>
<label class="inline"><input type="checkbox" name="hobbies[]" value="Drawing"> Drawing</label>
<label class="inline"><input type="checkbox" name="hobbies[]" value="Singing"> Singing</label>
<label class="inline"><input type="checkbox" name="hobbies[]" value="Dancing"> Dancing</label>
<label class="inline"><input type="checkbox" name="hobbies[]" value="Sketching"> Sketching</label>
</div>

<div class="hobbies-line">
<label class="inline"><input type="checkbox" name="hobbies[]" value="Others"> Others</label>
<input type="text" name="other_hobby" class="small-input" placeholder="">
</div>

<!-- ✅ QUALIFICATION INLINE WITH TABLE -->
<div class="qualification-section">
    <div class="qualification-title">QUALIFICATION</div>

    <table>
    <tr>
    <th>Sl.No</th>
    <th>Examination</th>
    <th>Board</th>
    <th>Percentage</th>
    <th>Year of Passing</th>
    </tr>

    <tr>
    <td>1</td>
    <td>Class X</td>
    <td><input type="text" name="board1" required></td>
    <td><input type="text" name="percent1" maxlength="5" required></td>
    <td><input type="text" name="year1" required></td>
    </tr>

    <tr>
    <td>2</td>
    <td>Class XII</td>
    <td><input type="text" name="board2" required></td>
    <td><input type="text" name="percent2" maxlength="5" required></td>
    <td><input type="text" name="year2" required></td>
    </tr>

    <tr>
    <td>3</td>
    <td>Graduation</td>
    <td><input type="text" name="board3"></td>
    <td><input type="text" name="percent3" maxlength="5"></td>
    <td><input type="text" name="year3"></td>
    </tr>

    <tr>
    <td>4</td>
    <td>Masters</td>
    <td><input type="text" name="board4"></td>
    <td><input type="text" name="percent4" maxlength="5"></td>
    <td><input type="text" name="year4"></td>
    </tr>
    </table>
</div>

<!-- NOTES -->
<div class="table-notes">
    <div></div>
    <div></div>
    <div>(10 char max)</div>
    <div>(upto 2 decimal)</div>
    <div></div>
</div>

<div class="form-row">
<label>COURSES APPLIED FOR</label>
<label class="inline"><input type="radio" name="course" value="BCA" required> BCA</label>
<label class="inline"><input type="radio" name="course" value="B.Com"> B.Com</label>
<label class="inline"><input type="radio" name="course" value="B.Sc"> B.Sc</label>
<label class="inline"><input type="radio" name="course" value="B.A"> B.A</label>
</div>

<div class="buttons">
<button type="submit">Submit</button>
<button type="reset">Reset</button>
</div>

<!-- FOOTER WITH UNDERLINE -->
<div class="footer">
    <hr>
</div>

</form>
</div>

</body>
</html>