const loadData = async () => {
  try {
    let res = await fetch("api/index.php");
    let data = await res.json();
    document.body.textContent = JSON.stringify(data);
  } catch (error) {
    console.log(error);
  }
};

loadData();
