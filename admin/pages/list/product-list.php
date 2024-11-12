 <table class=" rounded-lg w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
   <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
     <h2 class="p-2 pb-2 text-3xl font-extrabold text-white uppercase bg-gray-50 dark:bg-gray-700 ">Товары

       <a href="pages/add_product.php" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Добавить</a>
     </h2>

     <tr>
       <th scope=" col" class="px-6 py-3">
         id
       </th>
       <th scope="col" class="px-6 py-3">
         Название
       </th>
       <th scope="col" class="px-6 py-3">
         Описание
       </th>
       <th scope="col" class="px-6 py-3">
         Цена
       </th>
       <th scope="col" class="px-6 py-3">
         Категория
       </th>
       <th scope="col" class="px-6 py-3">
       </th>
       <th scope="col" class="px-6 py-3">
       </th>
     </tr>
   </thead>
   <tbody>
     <?php while ($row = mysqli_fetch_assoc($result)): ?>
       <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
         <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
           <?php echo $row['id']; ?>
         </th>
         <td class="px-6 py-4">
           <?php echo $row['name']; ?>
         </td>
         <td class="px-6 py-4">
           <?php echo $row['description']; ?>
         </td>
         <td class="px-6 py-4">
           <?php echo $row['price']; ?>
         </td>
         <td class="px-6 py-4">
           <?php echo $row['category_name']; ?>
         </td>
         <td class="px-6 py-4">
           <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="pages/edit_product.php?id=<?php echo $row['id']; ?>">Редактировать</a>
         </td>
         <td><a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="pages/delete_product.php?id=<?php echo $row['id']; ?>">Удалить</a></td>
       </tr>
     <?php endwhile; ?>
   </tbody>
 </table>
