import van from "@/van";

const { button, div, h1, p } = van.tags;

const loadData = async () => {
  try {
    let res = await fetch("api/index.php");
    let data = await res.json();
    return data;
  } catch (error) {
    console.log(error);
  }
};

const Hello = async () =>
  div(
    h1("Hello World"),
    p(JSON.stringify(await loadData())),
    button("Click Me", { onclick: () => alert("Hello World") })
  );

van.add(document.body, Hello());
