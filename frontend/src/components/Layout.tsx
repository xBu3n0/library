import { useCallback, useEffect, useState } from "react";
import Header from "./Header";
import { Outlet } from "react-router-dom";
import api from "../axios/api";

export default function Layout() {
  const [cartCounter, setCartCounter] = useState<number>(0);

  const fetchCart = useCallback(async () => {
    const result = await api.get("/cartCounter");
    console.log(result.data);

    setCartCounter(result.data.cartCounter);
  }, []);

  useEffect(() => {
    fetchCart();
  }, [fetchCart]);

  return (
    <>
      <Header cartCounter={cartCounter} />
      <Outlet context={{ setCartCounter: setCartCounter }} />
    </>
  );
}
