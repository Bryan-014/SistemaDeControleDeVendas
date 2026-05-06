import { Router } from "express";
import { CreateUserController } from "../controllers/user_controller.ts";

const userRoutes = Router();

const createUserController = new CreateUserController();

userRoutes.post("/", createUserController.handle); 

export { userRoutes };