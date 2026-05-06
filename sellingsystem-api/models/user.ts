import {
  Model,
  DataTypes,
  Optional
} from "sequelize";
import { sequelize } from "../src/database/index.ts";

// atributos do banco
interface IUserAttributes {
  id: string;
  username: string;
  password: string;
  role: string;
  cpf?: string | undefined;
  active: boolean;
  created_at: Date;
  updated_at: Date;
  deleted_at?: Date;
}

type IUserCreationAttributes = Optional<
  IUserAttributes,
  "id" | "role" | "cpf" | "active" | "created_at" | "updated_at" | "deleted_at"
>;

export class User
  extends Model<IUserAttributes, IUserCreationAttributes>
  implements IUserAttributes {

  public id!: string;
  public username!: string;
  public password!: string;
  public role!: string;
  public cpf?: string | undefined;
  public active!: boolean;

  public readonly created_at!: Date;
  public readonly updated_at!: Date;
  public readonly deleted_at!: Date;
}

User.init(
  {
    id: {
      type: DataTypes.UUID,
      defaultValue: DataTypes.UUIDV4,
      primaryKey: true
    },
    username: {
      type: DataTypes.STRING,
      allowNull: false
    },
    password: {
      type: DataTypes.STRING,
      allowNull: false
    },
    role: {
      type: DataTypes.STRING,
      defaultValue: "normal"
    },
    cpf: {
      type: DataTypes.STRING
    },
    active: {
      type: DataTypes.BOOLEAN,
      defaultValue: true
    },
    created_at: DataTypes.DATE,
    updated_at: DataTypes.DATE,
    deleted_at: DataTypes.DATE
  },
  {
    sequelize,
    tableName: "users",
    timestamps: true,
    paranoid: true, // soft delete
    underscored: true // snake_case
  }
);