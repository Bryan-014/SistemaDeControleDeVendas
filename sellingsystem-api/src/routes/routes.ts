import { Router } from "express";
import { userRoutes } from "./user_routes.ts";

const routes = Router();

routes.use("/api/v1/users", userRoutes);

export { routes };