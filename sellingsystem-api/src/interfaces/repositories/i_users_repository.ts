import { User } from "../../../models/user.ts";
import { CreateUserDTO } from "../../dto/create_user_dto.ts";

export interface IUsersRepository {
  create(data: CreateUserDTO): Promise<User>;
  findByUsername(username: string): Promise<User | null>;
  findById(id: string): Promise<User | null>;
}