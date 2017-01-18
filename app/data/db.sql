DROP TABLE IF EXISTS data_item;

CREATE TABLE data_item (
  id          INT AUTO_INCREMENT NOT NULL,
  anchor_text LONGTEXT           NOT NULL,
  link_status VARCHAR(255)       NOT NULL,
  from_url    LONGTEXT           NOT NULL,
  bldom       NUMERIC(10, 4)     NOT NULL,
  INDEX link_status_idx (link_status),
  INDEX bldom_idx (bldom) USING BTREE,
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;
