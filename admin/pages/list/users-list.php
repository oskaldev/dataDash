 <form action="pages/add_users.php" method="POST">
   <label for="username">Логин:</label>
   <input type="text" name="username" required>

   <label for="password">Пароль:</label>
   <input type="password" name="password" required>

   <label for="group_id">Группа:</label>
   <select name="group_id" required>
     <option value="1">Admin</option>
     <option value="2">Editor</option>
     <option value="3">User</option>
   </select>

   <button type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Добавить пользователя</button>
 </form>
 <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
   <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
     <h2 class=" mt-10 p-2 pb-2 text-3xl font-extrabold text-white uppercase bg-gray-50 dark:bg-gray-700 ">Пользователи</h2>
     <tr>
       <th scope=" col" class="px-6 py-3">
         id
       </th>
       <th scope="col" class="px-6 py-3">
         Логин
       </th>
       <th scope="col" class="px-6 py-3">
         Пароль
       </th>
       <th scope="col" class="px-6 py-3">
         Группа
       </th>
       <th scope="col" class="px-6 py-3">
       </th>
       <th scope="col" class="px-6 py-3">
       </th>
     </tr>
   </thead>
   <tbody>
     <?php while ($row = mysqli_fetch_assoc($customerResult)): ?>
       <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
         <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
           <?php echo $row['id']; ?>
         </th>
         <td class="px-6 py-4">
           <?php echo $row['username']; ?>
         </td>
         <td class="px-6 py-4">
           <?php echo $row['password']; ?>
         </td>
         <td class="px-6 py-4">
           <?php echo $row['group_name']; ?>
         </td>
         <td class="px-6 py-4">
           <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="pages/edit_users.php?id=<?php echo $row['id']; ?>">Редактировать</a>
         </td>
         <td><a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="pages/delete_users.php?id=<?php echo $row['id']; ?>">Удалить</a></td>
       </tr>
     <?php endwhile; ?>
   </tbody>
 </table>