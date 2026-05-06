import { Request, Response } from "express";
import { UsersRepository } from "../database/repositories/users_repository.ts";
import { CreateUserService } from "../services/users/create_user.ts";

export class CreateUserController {
  async handle(req: Request, res: Response) {
    const { username, password, cpf, role } = req.body;

    const repository = new UsersRepository();
    const service = new CreateUserService(repository);

    const user = await service.execute({ username, password, cpf, role });

    return res.json(user);
  }
}